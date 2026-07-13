<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivityLogTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->poll('30s')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable()
                    ->timezone('Asia/Jakarta')
                    ->width('165px'),

                TextColumn::make('user.name')
                    ->label('Admin')
                    ->default('Sistem')
                    ->icon('heroicon-m-user-circle')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('modul')
                    ->label('Modul')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ppdb'            => 'info',
                        'guru'            => 'success',
                        'siswa'           => 'warning',
                        'agenda'          => 'primary',
                        'berita'          => 'warning',
                        'ekstrakurikuler' => 'success',
                        'fasilitas'       => 'info',
                        'kelas'           => 'gray',
                        'prestasi'        => 'success',
                        'sejarah'         => 'primary',
                        'visi_misi'       => 'warning',
                        'user'            => 'gray',
                        'auth'            => 'danger',
                        'pengaturan'      => 'gray',
                        default           => 'primary',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ppdb'            => 'SPMB',
                        'visi_misi'       => 'Visi Misi',
                        'ekstrakurikuler' => 'Ekstrakurikuler',
                        default           => strtoupper($state),
                    })
                    ->searchable(),

                TextColumn::make('aksi')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        'login'   => 'info',
                        'logout'  => 'gray',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'created' => 'Tambah',
                        'updated' => 'Ubah',
                        'deleted' => 'Hapus',
                        'login'   => 'Login',
                        'logout'  => 'Logout',
                        default   => ucfirst($state),
                    }),

                TextColumn::make('deskripsi')
                    ->label('Keterangan')
                    ->wrap()
                    ->searchable(),

                TextColumn::make('ip_address')
                    ->label('IP')
                    ->color('gray')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('sesudah')
                    ->label('Perubahan')
                    ->formatStateUsing(function ($state, $record): string {
                        $sebelum = $record->sebelum ?? [];
                        $sesudah = $record->sesudah ?? [];
                        $aksi = $record->aksi;

                        if ($aksi === 'created' && !empty($sesudah)) {
                            $fields = [];
                            foreach ($sesudah as $key => $val) {
                                if (in_array($key, ['created_at', 'updated_at', 'id', 'password', 'remember_token'])) continue;
                                if (is_array($val)) {
                                    $val = json_encode($val);
                                }
                                $fields[] = "{$key}: {$val}";
                            }
                            return implode(' | ', array_slice($fields, 0, 3)) ?: '-';
                        }

                        if ($aksi === 'deleted' && !empty($sebelum)) {
                            $fields = [];
                            foreach ($sebelum as $key => $val) {
                                if (in_array($key, ['created_at', 'updated_at', 'id', 'password', 'remember_token'])) continue;
                                if (is_array($val)) {
                                    $val = json_encode($val);
                                }
                                $fields[] = "{$key}: {$val}";
                            }
                            return implode(' | ', array_slice($fields, 0, 3)) ?: '-';
                        }

                        if ($aksi === 'updated' && !empty($sebelum) && !empty($sesudah)) {
                            $changes = [];
                            foreach ($sesudah as $key => $val) {
                                if ($key === 'updated_at') continue;
                                $lama = $sebelum[$key] ?? '–';
                                if (is_array($lama)) $lama = json_encode($lama);
                                if (is_array($val)) $val = json_encode($val);
                                $changes[] = "{$key}: {$lama} → {$val}";
                            }
                            return implode(' | ', array_slice($changes, 0, 3)) ?: '-';
                        }

                        return '-';
                    })
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('modul')
                    ->label('Modul')
                    ->options([
                        'ppdb'            => 'SPMB',
                        'guru'            => 'Guru',
                        'siswa'           => 'Siswa',
                        'agenda'          => 'Agenda',
                        'berita'          => 'Berita',
                        'ekstrakurikuler' => 'Ekstrakurikuler',
                        'fasilitas'       => 'Fasilitas',
                        'kelas'           => 'Kelas',
                        'prestasi'        => 'Prestasi',
                        'sejarah'         => 'Sejarah',
                        'visi_misi'       => 'Visi Misi',
                        'user'            => 'User',
                        'auth'            => 'Login/Logout',
                        'pengaturan'      => 'Pengaturan',
                    ]),

                SelectFilter::make('aksi')
                    ->label('Aksi')
                    ->options([
                        'created' => 'Tambah Data',
                        'updated' => 'Ubah Data',
                        'deleted' => 'Hapus Data',
                        'login'   => 'Login',
                        'logout'  => 'Logout',
                    ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Log Terpilih'),
                ]),
            ]);
    }
}
