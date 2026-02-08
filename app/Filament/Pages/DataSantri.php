<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataSantri extends Page
{
    protected static $navigationIcon = 'heroicon-o-identification';

    protected static $navigationGroup = 'Master Data';

    protected static $navigationLabel = 'Data Santri';

    protected static ?string $title = 'Data Santri Pondok';

    protected static ?int $navigationSort = 7;

    protected static string $view = 'filament.pages.coming-soon';
}
