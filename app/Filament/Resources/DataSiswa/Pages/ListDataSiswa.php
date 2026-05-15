<?php

namespace App\Filament\Resources\DataSiswa\Pages;

use App\Filament\Resources\DataSiswa\DataSiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListDataSiswa extends ListRecords
{
    protected static string $resource = DataSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
