<?php

namespace App\Filament\Widgets;

use App\Models\PpdbRegistrant;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPpdbWidget extends BaseWidget
{


    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Pendaftar PPDB Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->query(
                PpdbRegistrant::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->label('Asal Sekolah')
                    ->icon('heroicon-m-academic-cap')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('L/P')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => $state === 'L' ? 'Laki-laki' : 'Perempuan')
                    ->color(fn(string $state): string => match ($state) {
                        'L' => 'info',
                        'P' => 'pink',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'verified' => 'warning',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Daftar')
                    ->dateTime('d M Y H:i:s')
                    ->description(fn(PpdbRegistrant $record): string => $record->created_at->diffForHumans())
                    ->color('gray'),
            ]);
    }
}
