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
use Illuminate\Support\Str;
use Closure;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($set, ?string $state) {
                        if ($state) {
                            $set('slug', Str::slug($state));
                        }
                    }),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Otomatis terisi dari judul, bisa diedit manual'),
                RichEditor::make('konten')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('gambar')
                    ->image()
                    ->directory('berita-images')
                    ->maxSize(10240) // 10MB dalam KB
                    ->helperText('Maksimal ukuran file: 10MB'),
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
