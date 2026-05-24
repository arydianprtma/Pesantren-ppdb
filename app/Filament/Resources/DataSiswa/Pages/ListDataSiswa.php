<?php

namespace App\Filament\Resources\DataSiswa\Pages;

use App\Filament\Resources\DataSiswa\DataSiswaResource;
use Filament\Resources\Pages\ListRecords;

class ListDataSiswa extends ListRecords
{
    protected static string $resource = DataSiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('export_excel')
                ->label('Export Excel')
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->url(route('export.siswa.excel')),
            \Filament\Actions\Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('danger')
                ->url(route('export.siswa.pdf')),
        ];
    }
}
