<?php

namespace App\Filament\Resources\Fasilitases\Pages;

use App\Filament\Resources\Fasilitases\FasilitasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFasilitases extends ListRecords
{
    protected static string $resource = FasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
