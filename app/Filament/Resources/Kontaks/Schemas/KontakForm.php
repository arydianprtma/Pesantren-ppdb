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
                            ->label('Link Google Maps (Iframe/URL)')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
            ]);
    }
}
