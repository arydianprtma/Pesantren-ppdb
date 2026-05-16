<?php

namespace App\Filament\Resources\VisiMisis\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class VisiMisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Visi & Misi')
                    ->description('Atur visi dan misi utama pondok pesantren.')
                    ->schema([
                        RichEditor::make('visi')
                            ->label('Visi')
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('misi')
                            ->label('Misi')
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),

                Section::make('Profil Pengasuh')
                    ->description('Informasi pengasuh yang akan ditampilkan di halaman Visi & Misi.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nama_pengasuh')
                                    ->label('Nama Pengasuh')
                                    ->placeholder('Contoh: KH. Ahmad Dahlan')
                                    ->maxLength(255),
                                FileUpload::make('foto_pengasuh')
                                    ->label('Foto Pengasuh')
                                    ->image()
                                    ->imageResizeTargetWidth(800)
                                    ->directory('pengasuh')
                                    ->maxSize(3072)
                                    ->helperText('Format: JPG, PNG. Maksimal 3MB. Gambar akan dioptimalkan otomatis.'),
                            ]),
                        Textarea::make('kata_sambutan')
                            ->label('Kata Sambutan / Biografi Singkat')
                            ->rows(5)
                            ->placeholder('Tuliskan kata sambutan atau profil singkat pengasuh...')
                            ->columnSpanFull(),
                    ])
            ]);
    }
}
