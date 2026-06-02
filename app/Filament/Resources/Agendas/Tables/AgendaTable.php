<?php

namespace App\Filament\Resources\Agendas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AgendaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->label('Judul Agenda')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ppdb' => 'success',
                        'akademik' => 'info',
                        'umum' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ppdb' => 'PPDB',
                        'akademik' => 'Akademik',
                        'umum' => 'Umum',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('tgl_mulai')
                    ->label('Tanggal Mulai')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('jam_mulai')
                    ->label('Waktu')
                    ->formatStateUsing(function ($record): string {
                        if (!$record->jam_mulai) return '-';
                        $waktu = substr($record->jam_mulai, 0, 5);
                        if ($record->jam_selesai) {
                            $waktu .= ' - ' . substr($record->jam_selesai, 0, 5);
                        }
                        return $waktu . ' WIB';
                    }),

                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->options([
                        'ppdb' => 'PPDB',
                        'akademik' => 'Akademik',
                        'umum' => 'Umum',
                    ]),
                SelectFilter::make('is_active')
                    ->label('Status Aktif')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Nonaktif',
                    ]),
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
