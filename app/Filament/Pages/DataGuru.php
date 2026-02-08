<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataGuru extends Page
{
    protected static $navigationIcon = 'heroicon-o-academic-cap';

    protected static $navigationGroup = 'Master Data';

    protected static $navigationLabel = 'Data Guru';

    protected static ?string $title = 'Data Guru';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.pages.coming-soon';
}
