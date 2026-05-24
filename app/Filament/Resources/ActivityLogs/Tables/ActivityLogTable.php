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
                        'spmb'       => 'info',
                        'guru'       => 'success',
                        'siswa'      => 'warning',
                        'auth'       => 'danger',
                        'pengaturan' => 'gray',
                        default      => 'primary',
                    })
                    ->formatStateUsing(fn (string $state): string => strtoupper($state))
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

                        if (empty($sebelum) || empty($sesudah)) {
                            return '-';
                        }

                        $changes = [];
                        foreach ($sesudah as $key => $val) {
                            if ($key === 'updated_at') continue;
                            $lama = $sebelum[$key] ?? '–';
                            $changes[] = "{$key}: {$lama} → {$val}";
                        }

                        return implode(' | ', array_slice($changes, 0, 3)) ?: '-';
                    })
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('modul')
                    ->label('Modul')
                    ->options([
                        'spmb'       => 'SPMB',
                        'guru'       => 'Guru',
                        'siswa'      => 'Siswa',
                        'auth'       => 'Login/Logout',
                        'pengaturan' => 'Pengaturan',
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
