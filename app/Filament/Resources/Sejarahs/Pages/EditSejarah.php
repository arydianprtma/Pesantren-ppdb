<?php

namespace App\Filament\Resources\Sejarahs\Pages;

use App\Filament\Resources\Sejarahs\SejarahResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSejarah extends EditRecord
{
    protected static string $resource = SejarahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \Illuminate\Support\Facades\Cache::forget('sejarahs');
    }
}
