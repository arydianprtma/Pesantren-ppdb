<?php

namespace App\Filament\Resources\Sejarahs\Pages;

use App\Filament\Resources\Sejarahs\SejarahResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSejarahs extends ListRecords
{
    protected static string $resource = SejarahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
