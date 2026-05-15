<?php

namespace App\Filament\Resources\VisiMisis\Pages;

use App\Filament\Resources\VisiMisis\VisiMisiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVisiMisi extends CreateRecord
{
    protected static string $resource = VisiMisiResource::class;

    protected function afterCreate(): void
    {
        \Illuminate\Support\Facades\Cache::forget('home_visi_misi');
    }
}
