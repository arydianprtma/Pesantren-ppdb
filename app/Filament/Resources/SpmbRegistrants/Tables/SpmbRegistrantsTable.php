<?php

namespace App\Filament\Resources\SpmbRegistrants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SpmbRegistrantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->poll('10s')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('no_reg')
                    ->label('No. Reg')
                    ->searchable()
                    ->copyable()
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('siswa.nama_lengkap')
                    ->label('Nama Calon Santri')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('tingkat')
                    ->label('Tingkat')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => strtoupper($state))
                    ->color(fn (string $state): string => match ($state) {
                        'smp'   => 'warning',
                        'sma'   => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('siswa.jenis_kelamin')
                    ->label('L/P')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'L'     => 'info',
                        'P'     => 'pink',
                        default => 'gray',
                    }),

                TextColumn::make('siswa.no_hp')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-phone')
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'         => 'gray',
                        'jadwal_tes'      => 'info',
                        'tes_berlangsung' => 'warning',
                        'wawancara'       => 'purple',
                        'diterima_ula',
                        'diterima_wustho',
                        'diterima_ulya'   => 'success',
                        'ditolak'         => 'danger',
                        default           => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending'         => 'Menunggu',
                        'jadwal_tes'      => 'Jadwal Tes',
                        'tes_berlangsung' => 'Tes Berlangsung',
                        'wawancara'       => 'Wawancara',
                        'diterima_ula'    => 'Diterima - Ula',
                        'diterima_wustho' => 'Diterima - Wustho',
                        'diterima_ulya'   => 'Diterima - Ulya',
                        'ditolak'         => 'Tidak Diterima',
                        default           => ucfirst($state),
                    }),

                TextColumn::make('tanggal_daftar')
                    ->label('Tgl Daftar')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('tingkat')
                    ->options([
                        'smp' => 'SMP',
                        'sma' => 'SMA',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'pending'         => 'Menunggu Verifikasi',
                        'jadwal_tes'      => 'Jadwal Tes Ditentukan',
                        'tes_berlangsung' => 'Tes Berlangsung',
                        'wawancara'       => 'Wawancara',
                        'diterima_ula'    => 'Diterima - Ula',
                        'diterima_wustho' => 'Diterima - Wustho',
                        'diterima_ulya'   => 'Diterima - Ulya',
                        'ditolak'         => 'Tidak Diterima',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
