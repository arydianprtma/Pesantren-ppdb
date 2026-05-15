<?php

namespace App\Filament\Resources\Fasilitases\Pages;

use App\Filament\Resources\Fasilitases\FasilitasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFasilitas extends EditRecord
{
    protected static string $resource = FasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \Illuminate\Support\Facades\Cache::forget('fasilitases');
    }
}
