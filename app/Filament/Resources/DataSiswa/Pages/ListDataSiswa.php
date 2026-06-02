<?php

namespace App\Filament\Resources\DataSiswa\Pages;

use App\Filament\Resources\DataSiswa\DataSiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListDataSiswa extends ListRecords
{
    protected static string $resource = DataSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('import_csv')
                ->label('Impor CSV')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('info')
                ->form([
                    \Filament\Forms\Components\FileUpload::make('file')
                        ->label('Pilih File CSV')
                        ->acceptedFileTypes(['text/csv', 'text/plain', 'application/vnd.ms-excel'])
                        ->required()
                        ->helperText(new \Illuminate\Support\HtmlString('Silakan unduh <a href="' . route('export.siswa.template') . '" class="text-primary-600 underline font-bold" target="_blank">Template CSV</a> terlebih dahulu untuk mencocokkan format data.')),
                ])
                ->action(function (array $data, \Filament\Actions\Action $action) {
                    $filePath = \Illuminate\Support\Facades\Storage::disk('public')->path($data['file']);
                    
                    if (($handle = fopen($filePath, 'r')) !== false) {
                        // Check for BOM (Byte Order Mark) from Excel
                        $bom = fread($handle, 3);
                        if ($bom !== "\xEF\xBB\xBF") {
                            rewind($handle);
                        }
                        
                        // Detect separator dynamically (comma or semicolon)
                        $firstLine = fgets($handle);
                        $separator = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';
                        rewind($handle);
                        if ($bom === "\xEF\xBB\xBF") {
                            fseek($handle, 3); // Skip BOM if present
                        }
                        
                        $headers = fgetcsv($handle, 1000, $separator);
                        
                        if (!$headers) {
                            \Filament\Notifications\Notification::make()
                                ->danger()
                                ->title('Gagal Impor')
                                ->body('File CSV kosong atau tidak valid.')
                                ->send();
                            fclose($handle);
                            return;
                        }
                        
                        // Normalize headers
                        $headers = array_map(function($header) {
                            return trim(strtolower(preg_replace('/[^a-zA-Z0-9_]/', '', $header)));
                        }, $headers);
                        
                        // Check required headers
                        $requiredHeaders = ['nama_lengkap', 'jenis_kelamin', 'no_hp', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'tingkat', 'status_penerimaan'];
                        foreach ($requiredHeaders as $req) {
                            if (!in_array($req, $headers)) {
                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Gagal Impor')
                                    ->body("Format CSV tidak sesuai. Kolom '{$req}' tidak ditemukan.")
                                    ->send();
                                fclose($handle);
                                $action->halt();
                                return;
                            }
                        }
                        
                        $errors = [];
                        $rowCount = 0;
                        $successCount = 0;
                        
                        \Illuminate\Support\Facades\DB::beginTransaction();
                        try {
                            while (($row = fgetcsv($handle, 1000, $separator)) !== false) {
                                $rowCount++;
                                
                                // Skip empty rows
                                if (empty(array_filter($row))) {
                                    continue;
                                }
                                
                                if (count($headers) !== count($row)) {
                                    $row = array_pad($row, count($headers), '');
                                }
                                
                                $dataRow = array_combine($headers, $row);
                                
                                // Clean values
                                foreach ($dataRow as $key => $value) {
                                    $dataRow[$key] = trim($value);
                                }
                                
                                $rowErrors = [];
                                
                                // Validate required fields
                                if (empty($dataRow['nama_lengkap'])) {
                                    $rowErrors[] = "Nama Lengkap kosong";
                                }
                                
                                $jk = strtoupper($dataRow['jenis_kelamin']);
                                if ($jk !== 'L' && $jk !== 'P') {
                                    $rowErrors[] = "Jenis Kelamin '{$dataRow['jenis_kelamin']}' tidak valid (harus L/P)";
                                }
                                
                                if (empty($dataRow['no_hp'])) {
                                    $rowErrors[] = "Nomor HP kosong";
                                } else {
                                    // Check if no_hp/whatsapp unique
                                    if (\App\Models\SpmbSiswa::where('no_hp', $dataRow['no_hp'])->exists()) {
                                        $rowErrors[] = "Nomor HP '{$dataRow['no_hp']}' sudah terdaftar pada siswa lain";
                                    }
                                    if (\App\Models\User::where('whatsapp', $dataRow['no_hp'])->exists()) {
                                        $rowErrors[] = "Nomor WhatsApp '{$dataRow['no_hp']}' sudah terdaftar pada user lain";
                                    }
                                }
                                
                                if (!empty($dataRow['nik'])) {
                                    if (strlen($dataRow['nik']) !== 16) {
                                        $rowErrors[] = "NIK harus 16 digit";
                                    }
                                    if (\App\Models\SpmbSiswa::where('nik', $dataRow['nik'])->exists()) {
                                        $rowErrors[] = "NIK '{$dataRow['nik']}' sudah terdaftar";
                                    }
                                }
                                
                                if (!empty($dataRow['nisn'])) {
                                    if (strlen($dataRow['nisn']) !== 10) {
                                        $rowErrors[] = "NISN harus 10 digit";
                                    }
                                    if (\App\Models\SpmbSiswa::where('nisn', $dataRow['nisn'])->exists()) {
                                        $rowErrors[] = "NISN '{$dataRow['nisn']}' sudah terdaftar";
                                    }
                                }
                                
                                if (!empty($dataRow['nis'])) {
                                    if (\App\Models\SpmbSiswa::where('nis', $dataRow['nis'])->exists()) {
                                        $rowErrors[] = "NIS '{$dataRow['nis']}' sudah terdaftar";
                                    }
                                }
                                
                                if (empty($dataRow['tempat_lahir'])) {
                                    $rowErrors[] = "Tempat Lahir kosong";
                                }
                                
                                if (empty($dataRow['tanggal_lahir'])) {
                                    $rowErrors[] = "Tanggal Lahir kosong";
                                } else {
                                    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataRow['tanggal_lahir'])) {
                                        $rowErrors[] = "Format Tanggal Lahir '{$dataRow['tanggal_lahir']}' salah (harus YYYY-MM-DD)";
                                    }
                                }
                                
                                $tingkat = strtolower($dataRow['tingkat']);
                                if ($tingkat !== 'smp' && $tingkat !== 'sma') {
                                    $rowErrors[] = "Tingkat '{$dataRow['tingkat']}' salah (harus smp/sma)";
                                }
                                
                                $status = strtolower($dataRow['status_penerimaan']);
                                $validStatuses = ['diterima_ula', 'diterima_wustho', 'diterima_ulya'];
                                if (!in_array($status, $validStatuses)) {
                                    $rowErrors[] = "Status Penerimaan '{$dataRow['status_penerimaan']}' salah (harus diterima_ula/diterima_wustho/diterima_ulya)";
                                }
                                
                                if (!empty($rowErrors)) {
                                    $errors[] = "Baris " . ($rowCount + 1) . ": " . implode(', ', $rowErrors);
                                    continue;
                                }
                                
                                // Create User
                                $email = $dataRow['email'];
                                if (empty($email)) {
                                    $email = ($dataRow['nik'] ?: $dataRow['no_hp']) . '@riyadussalikin.sch.id';
                                }
                                
                                if (\App\Models\User::where('email', $email)->exists()) {
                                    $email = ($dataRow['nik'] ?: $dataRow['no_hp']) . '-' . rand(10, 99) . '@riyadussalikin.sch.id';
                                }
                                
                                $user = \App\Models\User::create([
                                    'name' => $dataRow['nama_lengkap'],
                                    'email' => $email,
                                    'whatsapp' => $dataRow['no_hp'],
                                    'password' => \Illuminate\Support\Facades\Hash::make('santri123'),
                                    'role' => 'siswa',
                                    'is_active' => true,
                                ]);
                                
                                // Create SpmbPendaftaran
                                $pendaftaran = \App\Models\SpmbPendaftaran::create([
                                    'user_id' => $user->id,
                                    'no_reg' => 'REG-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(2))),
                                    'tanggal_daftar' => now(),
                                    'tingkat' => $tingkat,
                                    'status' => $status,
                                ]);
                                
                                // Generate NIS
                                $nis = $dataRow['nis'];
                                if (empty($nis)) {
                                    $kodeJenjang = match ($status) {
                                        'diterima_ula' => '1',
                                        'diterima_wustho' => '2',
                                        'diterima_ulya' => '3',
                                        default => '0',
                                    };
                                    
                                    $year = date('y');
                                    $prefix = $year . $kodeJenjang;
                                    
                                    $lastSiswa = \App\Models\SpmbSiswa::where('nis', 'like', $prefix . '%')
                                        ->orderBy('nis', 'desc')
                                        ->first();
                                    
                                    $nextSeq = 1;
                                    if ($lastSiswa && $lastSiswa->nis) {
                                        $lastSeq = (int) substr($lastSiswa->nis, strlen($prefix));
                                        $nextSeq = $lastSeq + 1;
                                    }
                                    
                                    $nis = $prefix . sprintf('%04d', $nextSeq);
                                }
                                
                                // Create SpmbSiswa
                                \App\Models\SpmbSiswa::create([
                                    'pendaftaran_id' => $pendaftaran->id,
                                    'nama_lengkap' => $dataRow['nama_lengkap'],
                                    'jenis_kelamin' => $jk,
                                    'nik' => $dataRow['nik'] ?: null,
                                    'nisn' => $dataRow['nisn'] ?: null,
                                    'nis' => $nis,
                                    'no_hp' => $dataRow['no_hp'],
                                    'tempat_lahir' => $dataRow['tempat_lahir'],
                                    'tanggal_lahir' => $dataRow['tanggal_lahir'],
                                    'alamat' => $dataRow['alamat'],
                                    'kelurahan_desa' => $dataRow['kelurahan_desa'] ?: '-',
                                    'kecamatan' => $dataRow['kecamatan'] ?: '-',
                                    'kabupaten_kota' => $dataRow['kabupaten_kota'] ?: '-',
                                    'provinsi' => $dataRow['provinsi'] ?: '-',
                                    'asal_sekolah' => $dataRow['asal_sekolah'] ?: '-',
                                ]);
                                
                                $successCount++;
                            }
                            
                            fclose($handle);
                            
                            if (!empty($errors)) {
                                \Illuminate\Support\Facades\DB::rollBack();
                                $action->halt();
                                
                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Impor Gagal (Rollback)')
                                    ->body("Terdapat kesalahan pada file CSV:\n\n" . implode("\n", array_slice($errors, 0, 5)) . (count($errors) > 5 ? "\n...dan " . (count($errors) - 5) . " kesalahan lainnya." : ""))
                                    ->send();
                                return;
                            }
                            
                            \Illuminate\Support\Facades\DB::commit();
                            
                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Impor Berhasil')
                                ->body("Berhasil mengimpor {$successCount} data siswa baru.")
                                ->send();
                                
                        } catch (\Exception $e) {
                            \Illuminate\Support\Facades\DB::rollBack();
                            fclose($handle);
                            $action->halt();
                            
                            \Filament\Notifications\Notification::make()
                                ->danger()
                                ->title('Terjadi Kesalahan')
                                ->body($e->getMessage())
                                ->send();
                        }
                    } else {
                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Gagal Membuka File')
                            ->body('File CSV tidak dapat dibaca.')
                            ->send();
                        $action->halt();
                    }
                }),
            \Filament\Actions\Action::make('export_excel')
                ->label('Export Excel')
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->url(route('export.siswa.excel')),
            \Filament\Actions\Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('danger')
                ->url(route('export.siswa.pdf')),
        ];
    }
}
