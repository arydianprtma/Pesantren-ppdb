<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class DataKelas extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Data Kelas';

    protected static ?string $title = 'Data Kelas';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.coming-soon';
}
