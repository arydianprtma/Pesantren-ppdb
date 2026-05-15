<?php

namespace App\Filament\Resources\Fasilitases\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class FasilitasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')
                    ->label('#')
                    ->sortable()
                    ->width('60px'),

                ImageColumn::make('gambar')
                    ->label('Foto')
                    ->square(),

                TextColumn::make('nama')
                    ->label('Nama Fasilitas')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('ikon')
                    ->label('Ikon')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'masjid'       => 'Masjid',
                        'asrama'       => 'Asrama',
                        'kelas'        => 'Ruang Kelas',
                        'perpustakaan' => 'Perpustakaan',
                        'komputer'     => 'Lab Komputer',
                        'olahraga'     => 'Lapangan',
                        'kantin'       => 'Kantin',
                        'klinik'       => 'Klinik',
                        default        => 'Lainnya',
                    }),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(60)
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
