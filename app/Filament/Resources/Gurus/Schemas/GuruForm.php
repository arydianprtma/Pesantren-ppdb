<?php

namespace App\Filament\Resources\Gurus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GuruForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data Tenaga Pengajar')
                ->description('Kelola data guru dan staf pengajar.')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Ust. Ahmad Fauzi, S.Pd.I'),

                    TextInput::make('nip')
                        ->label('NIP / NIY')
                        ->maxLength(50)
                        ->placeholder('Nomor Induk Pegawai/Yayasan'),

                    TextInput::make('jabatan')
                        ->label('Jabatan / Mata Pelajaran')
                        ->maxLength(255)
                        ->placeholder('Contoh: Guru Fiqih, Kepala Sekolah'),

                    FileUpload::make('foto')
                        ->image()
                        ->directory('guru')
                        ->saveUploadedFileUsing(function ($file) {
                            return \App\Services\ImageService::processUpload($file, 'guru', 600);
                        })
                        ->maxSize(2048)
                        ->helperText('Maksimal 2MB. Gambar akan di-resize dan dikonversi otomatis ke format WebP.'),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]),
        ]);
    }
}
