<?php

namespace App\Filament\Resources\Kelas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class KelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Kelas')
                ->description('Tambah atau edit data kelas beserta kapasitasnya.')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('nama')
                            ->label('Nama Kelas')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: SMP Kelas 7'),

                        Select::make('tingkat')
                            ->label('Tingkat / Unit')
                            ->options([
                                'smp' => 'SMP',
                                'sma' => 'SMA',
                            ])
                            ->required()
                            ->default('smp'),
                    ]),

                    Grid::make(2)->schema([
                        TextInput::make('kapasitas')
                            ->label('Kapasitas (Bobot Kelas)')
                            ->numeric()
                            ->required()
                            ->default(30)
                            ->helperText('Jumlah kapasitas siswa dalam kelas ini'),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),
                ]),
        ]);
    }
}
