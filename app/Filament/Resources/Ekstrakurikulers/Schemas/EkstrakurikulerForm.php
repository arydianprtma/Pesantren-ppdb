<?php

namespace App\Filament\Resources\Ekstrakurikulers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EkstrakurikulerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Ekstrakurikuler')
                ->description('Kelola data kegiatan ekstrakurikuler santri.')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Kegiatan')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Pramuka, PMR, Tahfidz'),

                    FileUpload::make('gambar')
                        ->label('Foto Kegiatan')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->directory('ekstrakurikuler')
                        ->maxSize(4096)
                        ->helperText('Format: JPG, PNG, WEBP (Maksimal 4MB). Gunakan editor gambar untuk memotong dan menyesuaikan posisi gambar sebelum mengunggah.'),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi Singkat')
                        ->rows(3)
                        ->placeholder('Jelaskan sedikit tentang kegiatan ini...')
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]),
        ]);
    }
}
