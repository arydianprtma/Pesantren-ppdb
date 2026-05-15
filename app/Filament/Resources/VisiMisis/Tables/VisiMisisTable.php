<?php

namespace App\Filament\Resources\VisiMisis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class VisiMisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('visi')
                    ->label('Visi')
                    ->lineClamp(3)
                    ->wrap()
                    ->tooltip(fn (string $state): string => strip_tags($state))
                    ->html()
                    ->searchable(),
                TextColumn::make('misi')
                    ->label('Misi')
                    ->lineClamp(3)
                    ->wrap()
                    ->tooltip(fn (string $state): string => strip_tags($state))
                    ->html()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
