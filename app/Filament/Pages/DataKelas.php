<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class DataKelas extends Page
{
    protected static $navigationIcon = 'heroicon-o-building-office-2';

    protected static $navigationGroup = 'Master Data';

    protected static $navigationLabel = 'Data Kelas';

    protected static ?string $title = 'Data Kelas';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.coming-soon';
}
