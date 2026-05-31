<?php

namespace App\Filament\Resources\SekolahProfils\Pages;

use App\Filament\Resources\SekolahProfils\SekolahProfilResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSekolahProfil extends EditRecord
{
    protected static string $resource = SekolahProfilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \Illuminate\Support\Facades\Cache::forget('smp_profil');
    }
}
