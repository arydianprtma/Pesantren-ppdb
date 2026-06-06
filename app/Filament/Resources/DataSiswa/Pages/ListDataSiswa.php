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
            \Filament\Actions\Action::make('download_template')
                ->label('Template CSV')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->url(route('export.siswa.template'))
                ->openUrlInNewTab(),
            \Filament\Actions\Action::make('import_csv')
                ->label('Impor CSV')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('info')
                ->form([
                    \Filament\Forms\Components\FileUpload::make('file')
                        ->label('Pilih File CSV')
                        ->disk('public')
                        ->acceptedFileTypes(['text/csv', 'text/plain', 'application/vnd.ms-excel'])
                        ->required()
                        ->helperText(new \Illuminate\Support\HtmlString('Silakan unduh <a href="' . route('export.siswa.template') . '" class="text-primary-600 underline font-bold" target="_blank">Template CSV</a> terlebih dahulu untuk mencocokkan format data.')),
                ])
                ->action(function (array $data, \Filament\Actions\Action $action) {
                    \Illuminate\Support\Facades\Log::info('Import CSV action started with data: ' . json_encode($data));
                    $filePath = \Illuminate\Support\Facades\Storage::disk('public')->path($data['file']);
                    \Illuminate\Support\Facades\Log::info('Import CSV file path resolved: ' . $filePath);
                    
                    $handle = null;
                    try {
                        if (($handle = fopen($filePath, 'r')) === false) {
                            throw new \Exception('File CSV tidak dapat dibuka.');
                        }

                        // Check for BOM (Byte Order Mark) from Excel
                        $bom = fread($handle, 3);
                        if ($bom !== "\xEF\xBB\xBF") {
                            rewind($handle);
                        }
                        
                        // Detect separator dynamically (comma or semicolon)
                        $firstLine = fgets($handle);
                        if ($firstLine === false) {
                            throw new \Exception('File CSV kosong atau tidak memiliki baris data.');
                        }
                        $separator = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';
                        rewind($handle);
                        if ($bom === "\xEF\xBB\xBF") {
                            fseek($handle, 3); // Skip BOM if present
                        }
                        
                        $headers = fgetcsv($handle, 1000, $separator);
                        
                        if (!$headers) {
                            throw new \Exception('File CSV kosong atau tidak valid.');
                        }
                        
                        // Normalize headers
                        $headers = array_map(function($header) {
                            return trim(strtolower(preg_replace('/[^a-zA-Z0-9_]/', '', $header)));
                        }, $headers);
                        
                        // Check required headers
                        $requiredHeaders = ['nama_lengkap', 'jenis_kelamin', 'no_hp', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'tingkat', 'status_penerimaan'];
                        foreach ($requiredHeaders as $req) {
                            if (!in_array($req, $headers)) {
                                throw new \Exception("Format CSV tidak sesuai. Kolom '{$req}' tidak ditemukan.");
                            }
                        }
                        
                        $errors = [];
                        $rowCount = 0;
                        $successCount = 0;

                        // In-memory lookups for high performance (reduces DB queries by thousands)
                        $existingPhoneSiswa = \App\Models\PpdbSiswa::pluck('no_hp')->flip()->toArray();
                        $existingWhatsappUser = \App\Models\User::whereNotNull('whatsapp')->pluck('whatsapp')->flip()->toArray();
                        $existingNik = \App\Models\PpdbSiswa::whereNotNull('nik')->pluck('nik')->flip()->toArray();
                        $existingNisn = \App\Models\PpdbSiswa::whereNotNull('nisn')->pluck('nisn')->flip()->toArray();
                        $existingNis = \App\Models\PpdbSiswa::whereNotNull('nis')->pluck('nis')->flip()->toArray();
                        $existingEmails = \App\Models\User::pluck('email')->flip()->toArray();
                        $existingNoRegs = \App\Models\PpdbPendaftaran::pluck('no_reg')->flip()->toArray();

                        // Pre-compute bcrypt password hash once to avoid 500x expensive CPU crypt cycles
                        $hashedPassword = \Illuminate\Support\Facades\Hash::make('santri123');

                        // Keep track of next sequences per prefix in memory to avoid running duplicate SELECT order-by queries per row
                        $nextSequences = [];
                        
                        \Illuminate\Support\Facades\DB::beginTransaction();
                        
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
                                // Check if no_hp/whatsapp unique using in-memory helper
                                if (isset($existingPhoneSiswa[$dataRow['no_hp']])) {
                                    $rowErrors[] = "Nomor HP '{$dataRow['no_hp']}' sudah terdaftar pada siswa lain";
                                }
                                if (isset($existingWhatsappUser[$dataRow['no_hp']])) {
                                    $rowErrors[] = "Nomor WhatsApp '{$dataRow['no_hp']}' sudah terdaftar pada user lain";
                                }
                            }
                            
                            if (!empty($dataRow['nik'])) {
                                if (strlen($dataRow['nik']) !== 16) {
                                    $rowErrors[] = "NIK harus 16 digit";
                                }
                                if (isset($existingNik[$dataRow['nik']])) {
                                    $rowErrors[] = "NIK '{$dataRow['nik']}' sudah terdaftar";
                                }
                            }
                            
                            if (!empty($dataRow['nisn'])) {
                                if (strlen($dataRow['nisn']) !== 10) {
                                    $rowErrors[] = "NISN harus 10 digit";
                                }
                                if (isset($existingNisn[$dataRow['nisn']])) {
                                    $rowErrors[] = "NISN '{$dataRow['nisn']}' sudah terdaftar";
                                }
                            }
                            
                            if (!empty($dataRow['nis'])) {
                                if (isset($existingNis[$dataRow['nis']])) {
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
                            $validStatuses = ['diterima_ula', 'diterima_idadiyah', 'diterima_wustho', 'diterima_ulya'];
                            if (!in_array($status, $validStatuses)) {
                                $rowErrors[] = "Status Penerimaan '{$dataRow['status_penerimaan']}' salah (harus diterima_ula/diterima_idadiyah/diterima_wustho/diterima_ulya)";
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
                            
                            while (isset($existingEmails[$email])) {
                                $email = ($dataRow['nik'] ?: $dataRow['no_hp']) . '-' . rand(100, 999) . '@riyadussalikin.sch.id';
                            }
                            $existingEmails[$email] = true;
                            
                            $user = \App\Models\User::create([
                                'name' => $dataRow['nama_lengkap'],
                                'email' => $email,
                                'whatsapp' => $dataRow['no_hp'],
                                'password' => $hashedPassword,
                                'role' => 'siswa',
                                'is_active' => true,
                            ]);
                            
                            // Create PpdbPendaftaran
                            $noReg = 'REG-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(4)));
                            while (isset($existingNoRegs[$noReg])) {
                                $noReg = 'REG-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(4)));
                            }
                            $existingNoRegs[$noReg] = true;

                            $pendaftaran = \App\Models\PpdbPendaftaran::create([
                                'user_id' => $user->id,
                                'no_reg' => $noReg,
                                'tanggal_daftar' => now(),
                                'tingkat' => $tingkat,
                                'status' => $status,
                            ]);
                            
                            // Generate NIS
                            $nis = $dataRow['nis'];
                            if (empty($nis)) {
                                $kodeKeagamaan = match ($status) {
                                    'diterima_ula' => '1',
                                    'diterima_idadiyah' => '2',
                                    'diterima_wustho' => '3',
                                    'diterima_ulya' => '4',
                                    default => '0',
                                };
                                
                                $kodeSekolah = match ($tingkat) {
                                    'smp' => '1',
                                    'sma' => '2',
                                    default => '0',
                                };
                                
                                $year = date('y');
                                $prefix = $year . $kodeKeagamaan . $kodeSekolah;
                                
                                if (!isset($nextSequences[$prefix])) {
                                    $lastSiswa = \App\Models\PpdbSiswa::where('nis', 'like', $prefix . '%')
                                        ->orderBy('nis', 'desc')
                                        ->first();
                                    
                                    $nextSeq = 1;
                                    if ($lastSiswa && $lastSiswa->nis) {
                                        $lastSeq = (int) substr($lastSiswa->nis, strlen($prefix));
                                        $nextSeq = $lastSeq + 1;
                                    }
                                    $nextSequences[$prefix] = $nextSeq;
                                }
                                
                                $nis = $prefix . sprintf('%04d', $nextSequences[$prefix]);
                                $nextSequences[$prefix]++;
                            }
                            
                            // Create PpdbSiswa
                            \App\Models\PpdbSiswa::create([
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

                            // Update in-memory collections to block subsequent row duplication checks
                            $existingPhoneSiswa[$dataRow['no_hp']] = true;
                            $existingWhatsappUser[$dataRow['no_hp']] = true;
                            if (!empty($dataRow['nik'])) {
                                $existingNik[$dataRow['nik']] = true;
                            }
                            if (!empty($dataRow['nisn'])) {
                                $existingNisn[$dataRow['nisn']] = true;
                            }
                            if (!empty($nis)) {
                                $existingNis[$nis] = true;
                            }
                            
                            $successCount++;
                        }
                        
                        if (is_resource($handle)) {
                            fclose($handle);
                        }
                        
                        if (!empty($errors)) {
                            \Illuminate\Support\Facades\DB::rollBack();
                            
                            \Filament\Notifications\Notification::make()
                                ->danger()
                                ->title('Impor Gagal (Rollback)')
                                ->body("Terdapat kesalahan pada file CSV:\n\n" . implode("\n", array_slice($errors, 0, 5)) . (count($errors) > 5 ? "\n...dan " . (count($errors) - 5) . " kesalahan lainnya." : ""))
                                ->send();
                                
                            $action->halt();
                        }
                        
                        \Illuminate\Support\Facades\DB::commit();
                        
                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Impor Berhasil')
                            ->body("Berhasil mengimpor {$successCount} data siswa baru.")
                            ->send();
                            
                    } catch (\Filament\Support\Exceptions\Halt $e) {
                        throw $e;
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error('Import CSV error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
                        if (isset($handle) && is_resource($handle)) {
                            fclose($handle);
                        }
                        try {
                            \Illuminate\Support\Facades\DB::rollBack();
                        } catch (\Exception $dbEx) {}
                        
                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Terjadi Kesalahan')
                            ->body($e->getMessage())
                            ->send();

                        $action->halt();
                    }
                }),
            \Filament\Actions\Action::make('export_excel')
                ->label('Export Excel')
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->url(fn ($livewire) => route('export.siswa.excel', [
                    'tingkat' => $livewire->tableFilters['tingkat']['value'] ?? null,
                ]))
                ->openUrlInNewTab(),
            \Filament\Actions\Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('danger')
                ->url(fn ($livewire) => route('export.siswa.pdf', [
                    'tingkat' => $livewire->tableFilters['tingkat']['value'] ?? null,
                ]))
                ->openUrlInNewTab(),
        ];
    }
}
