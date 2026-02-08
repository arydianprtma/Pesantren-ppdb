<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class JadwalPelajaran extends Page
{
    protected static $navigationIcon = 'heroicon-o-clock';

    protected static $navigationGroup = 'Master Data';

    protected static $navigationLabel = 'Jadwal Pelajaran';

    protected static ?string $title = 'Jadwal Pelajaran';

    protected static ?int $navigationSort = 5;

    protected static string $view = 'filament.pages.coming-soon';
}
