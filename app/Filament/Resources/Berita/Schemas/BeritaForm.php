<?php

namespace App\Filament\Resources\Berita\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use App\Models\WebSetting;
use Illuminate\Support\Str;
use Closure;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Pengaturan Cepat Media Sosial')
                    ->description('Atur link media sosial pondok yang akan muncul di sidebar berita. Klik untuk membuka/menutup.')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->placeholder('https://facebook.com/...')
                            ->dehydrated(false)
                            ->afterStateHydrated(fn (TextInput $component) => $component->state(WebSetting::first()?->facebook))
                            ->afterStateUpdated(fn ($state) => WebSetting::first()?->update(['facebook' => $state]))
                            ->live(onBlur: true),
                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('https://instagram.com/...')
                            ->dehydrated(false)
                            ->afterStateHydrated(fn (TextInput $component) => $component->state(WebSetting::first()?->instagram))
                            ->afterStateUpdated(fn ($state) => WebSetting::first()?->update(['instagram' => $state]))
                            ->live(onBlur: true),
                        TextInput::make('tiktok')
                            ->label('TikTok')
                            ->placeholder('https://tiktok.com/@...')
                            ->dehydrated(false)
                            ->afterStateHydrated(fn (TextInput $component) => $component->state(WebSetting::first()?->tiktok))
                            ->afterStateUpdated(fn ($state) => WebSetting::first()?->update(['tiktok' => $state]))
                            ->live(onBlur: true),
                    ])
                    ->columns(3),
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
                    ->imageResizeTargetWidth('1200')
                    ->imageQuality(80)
                    ->directory('berita-images')
                    ->maxSize(5120) // Kurangi ke 5MB agar tidak membebani RAM saat proses
                    ->helperText('Maksimal ukuran file: 5MB. Gambar akan dioptimalkan otomatis.'),
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
