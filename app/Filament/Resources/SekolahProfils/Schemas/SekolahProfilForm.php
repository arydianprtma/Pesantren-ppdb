<?php

namespace App\Filament\Resources\SekolahProfils\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class SekolahProfilForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profil & Visi Misi Sekolah')
                    ->description('Atur profil singkat beserta visi dan misi sekolah (SMP).')
                    ->schema([
                        RichEditor::make('profil')
                            ->label('Profil Sekolah')
                            ->placeholder('Tuliskan deskripsi/profil singkat sekolah di sini...')
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('visi')
                            ->label('Visi Sekolah')
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('misi')
                            ->label('Misi Sekolah')
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),

                Section::make('Statistik Sekolah')
                    ->description('Atur 4 poin statistik yang akan ditampilkan di halaman depan dan profil sekolah.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('stat_1_val')
                                            ->label('Statistik 1 (Nilai)')
                                            ->default('A')
                                            ->required(),
                                        TextInput::make('stat_1_lbl')
                                            ->label('Statistik 1 (Label)')
                                            ->default('Akreditasi BAN-SM')
                                            ->required(),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('stat_2_val')
                                            ->label('Statistik 2 (Nilai)')
                                            ->default('100%')
                                            ->required(),
                                        TextInput::make('stat_2_lbl')
                                            ->label('Statistik 2 (Label)')
                                            ->default('Kurikulum Terintegrasi')
                                            ->required(),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('stat_3_val')
                                            ->label('Statistik 3 (Nilai)')
                                            ->default('1:15')
                                            ->required(),
                                        TextInput::make('stat_3_lbl')
                                            ->label('Statistik 3 (Label)')
                                            ->default('Rasio Guru & Siswa')
                                            ->required(),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('stat_4_val')
                                            ->label('Statistik 4 (Nilai)')
                                            ->default('10+')
                                            ->required(),
                                        TextInput::make('stat_4_lbl')
                                            ->label('Statistik 4 (Label)')
                                            ->default('Fasilitas Penunjang')
                                            ->required(),
                                    ]),
                            ])
                    ]),

                Section::make('Sambutan Kepala Sekolah')
                    ->description('Informasi kepala sekolah dan kata sambutan yang akan ditampilkan di halaman Profil.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nama_kepsek')
                                    ->label('Nama Kepala Sekolah')
                                    ->placeholder('Contoh: Drs. H. Budi Santoso, M.Pd.')
                                    ->maxLength(255),
                                FileUpload::make('foto_kepsek')
                                    ->label('Foto Kepala Sekolah')
                                    ->image()
                                    ->directory('kepsek')
                                    ->saveUploadedFileUsing(function ($file) {
                                        return \App\Services\ImageService::processUpload($file, 'kepsek', 800);
                                    })
                                    ->maxSize(2048)
                                    ->helperText('Maksimal 2MB. Akan dioptimalkan otomatis.'),
                            ]),
                        Textarea::make('sambutan_kepsek')
                            ->label('Kata Sambutan Kepala Sekolah')
                            ->rows(6)
                            ->placeholder('Tuliskan kata sambutan kepala sekolah...')
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
