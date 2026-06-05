<?php

namespace App\Filament\Resources\PpdbSettings\Pages;

use App\Filament\Resources\PpdbSettings\PpdbSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePpdbSettings extends ManageRecords
{
    protected static string $resource = PpdbSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->hidden(fn () => PpdbSettingResource::getModel()::count() >= 1),
        ];
    }
}
