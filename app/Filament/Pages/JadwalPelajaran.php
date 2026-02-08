<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class JadwalPelajaran extends Page
{
    protected static string $view = 'filament.pages.coming-soon';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-clock';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function getNavigationLabel(): string
    {
        return 'Jadwal Pelajaran';
    }

    public function getTitle(): string
    {
        return 'Jadwal Pelajaran';
    }

    public static function getNavigationSort(): ?int
    {
        return 5;
    }
}
