<?php

namespace App\Filament\Resources\Prestasi\Pages;

use App\Filament\Resources\Prestasi\PrestasiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPrestasi extends EditRecord
{
    protected static string $resource = PrestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
