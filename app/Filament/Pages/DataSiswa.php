<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataSiswa extends Page
{
    protected static $navigationIcon = 'heroicon-o-users';

    protected static $navigationGroup = 'Master Data';

    protected static $navigationLabel = 'Data Siswa';

    protected static ?string $title = 'Data Siswa Sekolah';

    protected static ?int $navigationSort = 6;

    protected static string $view = 'filament.pages.coming-soon';
}
