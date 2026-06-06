<?php

namespace App\Filament\Resources\Ekstrakurikulers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                        ->directory('ekskul')
                        ->saveUploadedFileUsing(function ($file) {
                            return \App\Services\ImageService::processUpload($file, 'ekskul');
                        })
                        ->maxSize(2048)
                        ->columnSpanFull()
                        ->helperText('Maksimal 2MB. Gambar akan di-resize dan dikonversi otomatis ke format WebP.'),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi Singkat')
                        ->rows(3)
                        ->placeholder('Jelaskan sedikit tentang kegiatan ini...')
                        ->columnSpanFull(),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),

                    Select::make('tampil_di')
                        ->label('Target Tampilan')
                        ->options([
                            'sekolah' => 'Sekolah Saja (SMP)',
                            'pesantren' => 'Web Utama Pesantren Saja',
                            'keduanya' => 'Keduanya (Sekolah & Web Utama)',
                        ])
                        ->required()
                        ->default('keduanya'),
                ]),
        ]);
    }
}
