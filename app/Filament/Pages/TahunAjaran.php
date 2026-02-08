<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class TahunAjaran extends Page
{
    // use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Tahun Ajaran';

    protected static ?string $title = 'Tahun Ajaran';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.coming-soon';
}
