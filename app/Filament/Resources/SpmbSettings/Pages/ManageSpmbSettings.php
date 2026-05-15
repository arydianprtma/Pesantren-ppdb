<?php

namespace App\Filament\Resources\SpmbSettings\Pages;

use App\Filament\Resources\SpmbSettings\SpmbSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSpmbSettings extends ManageRecords
{
    protected static string $resource = SpmbSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->hidden(fn () => SpmbSettingResource::getModel()::count() >= 1),
        ];
    }
}
