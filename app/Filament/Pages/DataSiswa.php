<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataSiswa extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Data Siswa';

    protected static ?string $title = 'Data Siswa Sekolah';

    protected static ?int $navigationSort = 6;

    protected static string $view = 'filament.pages.coming-soon';
}
