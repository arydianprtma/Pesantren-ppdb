<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataGuru extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Data Guru';

    protected static ?string $title = 'Data Guru';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.pages.coming-soon';
}
