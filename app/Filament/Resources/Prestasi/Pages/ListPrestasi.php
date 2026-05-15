<?php

namespace App\Filament\Resources\Prestasi\Pages;

use App\Filament\Resources\Prestasi\PrestasiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPrestasi extends ListRecords
{
    protected static string $resource = PrestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
