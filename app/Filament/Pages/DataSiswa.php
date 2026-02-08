<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataSiswa extends Page
{
    protected static string $view = 'filament.pages.coming-soon';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-users';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Siswa';
    }

    public function getTitle(): string
    {
        return 'Data Siswa Sekolah';
    }

    public static function getNavigationSort(): ?int
    {
        return 6;
    }
}
