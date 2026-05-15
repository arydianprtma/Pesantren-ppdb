<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('whatsapp')
                    ->required(),
                Textarea::make('pesan')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_read')
                    ->required(),
            ]);
    }
}
