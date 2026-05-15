<?php

namespace App\Filament\Resources\Sejarahs\Pages;

use App\Filament\Resources\Sejarahs\SejarahResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSejarah extends CreateRecord
{
    protected static string $resource = SejarahResource::class;

    protected function afterCreate(): void
    {
        \Illuminate\Support\Facades\Cache::forget('sejarahs');
    }
}
