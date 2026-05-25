<?php

namespace App\Filament\Resources\Fasilitases\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class FasilitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Fasilitas')
                ->description('Tambah atau edit data fasilitas pondok pesantren.')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('nama')
                            ->label('Nama Fasilitas')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Masjid Al-Ikhlas'),

                        Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'Fasilitas Umum' => 'Fasilitas Umum',
                                'Ibadah' => 'Ibadah',
                                'Akademik' => 'Akademik',
                                'Asrama' => 'Asrama',
                                'Olahraga' => 'Olahraga',
                            ])
                            ->required()
                            ->default('Fasilitas Umum'),

                        Select::make('ikon')
                            ->label('Ikon')
                            ->required()
                            ->options([
                                'masjid'       => 'Masjid / Musholla',
                                'asrama'       => 'Asrama',
                                'kelas'        => 'Ruang Kelas',
                                'perpustakaan' => 'Perpustakaan',
                                'komputer'     => 'Lab Komputer',
                                'olahraga'     => 'Lapangan Olahraga',
                                'kantin'       => 'Kantin',
                                'klinik'       => 'Klinik / Kesehatan',
                                'lainnya'      => 'Lainnya',
                            ])
                            ->default('lainnya'),
                    ]),

                    FileUpload::make('gambar')
                        ->label('Foto Fasilitas')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->imageResizeTargetWidth(1200)
                        ->directory('fasilitas')
                        ->maxSize(4096) // 4MB
                        ->columnSpanFull()
                        ->helperText('Format: JPG, PNG, WEBP (Maksimal 4MB). Gunakan editor gambar untuk memotong dan menyesuaikan posisi gambar sebelum mengunggah.'),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->placeholder('Deskripsikan fasilitas ini secara singkat...')
                        ->columnSpanFull(),

                    Grid::make(2)->schema([
                        TextInput::make('urutan')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka kecil tampil lebih dulu'),

                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ]),
                ]),
        ]);
    }
}
