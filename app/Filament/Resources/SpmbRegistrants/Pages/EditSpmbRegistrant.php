<?php

namespace App\Filament\Resources\SpmbRegistrants\Pages;

use App\Filament\Resources\SpmbRegistrants\SpmbRegistrantResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpmbRegistrant extends EditRecord
{
    protected static string $resource = SpmbRegistrantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
