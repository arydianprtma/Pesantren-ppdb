<?php

namespace App\Filament\Widgets;

use App\Models\PpdbPendaftaran;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPpdbWidget extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Pendaftar PPDB Terbaru';

    protected function getListeners(): array
    {
        return [
            "echo:pendaftaran,.created" => '$refresh',
            "echo:pendaftaran,.updated" => '$refresh',
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->query(
                PpdbPendaftaran::query()->latest()->limit(5)
            )
            ->recordUrl(
                fn (PpdbPendaftaran $record): string => \App\Filament\Resources\PpdbRegistrants\PpdbRegistrantResource::getUrl('edit', ['record' => $record])
            )
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('tingkat')
                    ->label('Tingkat')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => strtoupper($state))
                    ->color(fn(string $state): string => match ($state) {
                        'smp' => 'warning',
                        'sma' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('siswa.jenis_kelamin')
                    ->label('L/P')
                    ->badge()
                    ->formatStateUsing(fn(?string $state): string => $state === 'L' ? 'Laki-laki' : 'Perempuan')
                    ->color(fn(?string $state): string => match ($state) {
                        'L' => 'info',
                        'P' => 'pink',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending'           => 'Menunggu',
                        'jadwal_tes'        => 'Jadwal Tes',
                        'tes_berlangsung'   => 'Tes Berlangsung',
                        'wawancara'         => 'Wawancara',
                        'diterima_ula'      => 'Diterima - Ula',
                        'diterima_idadiyah' => 'Diterima - Idadiyah',
                        'diterima_wustho'   => 'Diterima - Wustho',
                        'diterima_ulya'     => 'Diterima - Ulya',
                        'ditolak'           => 'Tidak Diterima',
                        'mengundurkan_diri' => 'Mengundurkan Diri',
                        default             => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending'         => 'gray',
                        'jadwal_tes'      => 'info',
                        'tes_berlangsung' => 'warning',
                        'wawancara'       => 'purple',
                        'diterima_ula',
                        'diterima_idadiyah',
                        'diterima_wustho',
                        'diterima_ulya'   => 'success',
                        'ditolak',
                        'mengundurkan_diri' => 'danger',
                        default           => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Daftar')
                    ->dateTime('d M Y H:i:s')
                    ->description(fn(PpdbPendaftaran $record): string => $record->created_at->diffForHumans())
                    ->color('gray'),
            ]);
    }
}
