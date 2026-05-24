<?php

namespace App\Filament\Resources\Kontaks\Pages;

use App\Filament\Resources\Kontaks\KontakResource;
use App\Models\Kontak;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListKontaks extends ListRecords
{
    protected static string $resource = KontakResource::class;

    public function mount(): void
    {
        parent::mount();

        // Jika sudah ada data, langsung redirect ke halaman edit
        $kontak = Kontak::first();
        if ($kontak) {
            $this->redirect(KontakResource::getUrl('edit', ['record' => $kontak]));
        }
    }

    public function getTitle(): string|Htmlable
    {
        return 'Informasi Kontak';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
