<?php

namespace App\Filament\Resources\Sejarahs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SejarahsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')
                    ->label('#')
                    ->sortable()
                    ->width('60px'),

                TextColumn::make('periode')
                    ->label('Periode')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('judul')
                    ->label('Judul / Fase')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('konten')
                    ->label('Isi')
                    ->lineClamp(3)
                    ->wrap()
                    ->tooltip(fn (string $state): string => strip_tags($state))
                    ->html()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('urutan')
            ->filters([])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
