<?php

namespace App\Filament\Resources\Beritas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                RichEditor::make('konten')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('gambar')
                    ->image()
                    ->directory('berita-images'),
                Select::make('kategori')
                    ->options([
                        'pengumuman' => 'Pengumuman',
                        'berita' => 'Berita',
                        'kegiatan' => 'Kegiatan'
                    ])
                    ->default('berita')
                    ->required(),
                Toggle::make('is_published')
                    ->label('Publikasikan')
                    ->default(true),
                DateTimePicker::make('published_at'),
            ]);
    }
}
