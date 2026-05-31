<?php

namespace App\Filament\Resources\SekolahProfils\Pages;

use App\Filament\Resources\SekolahProfils\SekolahProfilResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSekolahProfil extends CreateRecord
{
    protected static string $resource = SekolahProfilResource::class;

    protected function afterCreate(): void
    {
        \Illuminate\Support\Facades\Cache::forget('smp_profil');
    }
}
