<?php

namespace App\Filament\Resources\SekolahProfils\Pages;

use App\Filament\Resources\SekolahProfils\SekolahProfilResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSekolahProfils extends ListRecords
{
    protected static string $resource = SekolahProfilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
