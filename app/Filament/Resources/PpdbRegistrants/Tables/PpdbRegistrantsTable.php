<?php

namespace App\Filament\Resources\PpdbRegistrants\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PpdbRegistrantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'MTS' => 'warning',
                        'MA' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('asal_sekolah')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->icon('heroicon-m-academic-cap')
                    ->color('gray')
                    ->limit(20),
                TextColumn::make('jenis_kelamin')
                    ->label('L/P')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'L' => 'info',
                        'P' => 'pink',
                        default => 'gray',
                    }),
                TextColumn::make('no_hp')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-phone'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'verified' => 'info',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),
                TextColumn::make('created_at')
                    ->label('Tgl Daftar')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenjang'),
                SelectFilter::make('status'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
