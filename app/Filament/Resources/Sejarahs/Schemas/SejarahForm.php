<?php

namespace App\Filament\Resources\Sejarahs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SejarahForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data Sejarah')
                ->description('Tambah atau edit timeline sejarah pondok pesantren.')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('judul')
                            ->label('Judul / Fase')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Berdirinya Pondok Pesantren'),

                        TextInput::make('periode')
                            ->label('Periode / Tahun')
                            ->maxLength(100)
                            ->placeholder('Contoh: 1990, Awal, 1995–2000'),
                    ]),

                    RichEditor::make('konten')
                        ->label('Isi Sejarah')
                        ->required()
                        ->columnSpanFull()
                        ->placeholder('Ceritakan peristiwa atau fase sejarah ini...'),

                    Grid::make(2)->schema([
                        TextInput::make('urutan')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka kecil tampil lebih dulu (kronologis)'),

                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ]),
                ]),
        ]);
    }
}
