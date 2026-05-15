<?php

namespace App\Filament\Resources\Fasilitases\Pages;

use App\Filament\Resources\Fasilitases\FasilitasResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFasilitas extends CreateRecord
{
    protected static string $resource = FasilitasResource::class;

    protected function afterCreate(): void
    {
        \Illuminate\Support\Facades\Cache::forget('fasilitases');
    }
}
