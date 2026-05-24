<?php

namespace App\Filament\Resources\Kontaks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KontakForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kontak')
                    ->schema([
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        TextInput::make('telepon')
                            ->tel(),
                        TextInput::make('whatsapp')
                            ->label('Nomor WhatsApp')
                            ->tel(),
                        Textarea::make('alamat')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('maps_link')
                            ->label('Link Google Maps')
                            ->helperText('Cukup paste link dari Google Maps → klik "Bagikan" → "Salin link". Sistem otomatis mengkonversi ke format embed.')
                            ->placeholder('Contoh: https://maps.app.goo.gl/xxx  atau  https://www.google.com/maps/place/...')
                            ->rows(3)
                            ->columnSpanFull()
                    ])
                    ->columns(3)
            ]);
    }
}
