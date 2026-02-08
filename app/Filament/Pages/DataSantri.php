<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataSantri extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Data Santri';

    protected static ?string $title = 'Data Santri Pondok';

    protected static ?int $navigationSort = 7;

    protected static string $view = 'filament.pages.coming-soon';
}
