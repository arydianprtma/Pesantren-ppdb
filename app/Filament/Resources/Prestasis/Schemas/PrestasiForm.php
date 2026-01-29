<?php

namespace App\Filament\Resources\Prestasis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PrestasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Prestasi'),
                Select::make('kategori')
                    ->options([
                        'akademik' => 'Akademik',
                        'non_akademik' => 'Non-Akademik',
                        'keagamaan' => 'Keagamaan',
                    ])
                    ->required()
                    ->label('Kategori'),
                Select::make('tingkat')
                    ->options([
                        'Kecamatan' => 'Kecamatan',
                        'Kabupaten' => 'Kabupaten',
                        'Provinsi' => 'Provinsi',
                        'Nasional' => 'Nasional',
                        'Internasional' => 'Internasional',
                    ])
                    ->required()
                    ->searchable()
                    ->label('Tingkat'),
                TextInput::make('tahun')
                    ->required()
                    ->numeric()
                    ->minValue(2000)
                    ->maxValue(date('Y') + 1)
                    ->label('Tahun'),
                \Filament\Forms\Components\FileUpload::make('gambar')
                    ->image()
                    ->disk('public') // Force public disk
                    ->visibility('public')
                    ->directory('prestasi')
                    ->label('Foto Dokumentasi')
                    ->columnSpanFull(),
                Textarea::make('deskripsi')
                    ->columnSpanFull()
                    ->label('Deskripsi'),
            ]);
    }
}
