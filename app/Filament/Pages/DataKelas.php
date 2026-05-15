<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataKelas extends Page
{
    protected string $view = 'filament.pages.coming-soon';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-building-office-2';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Kelas';
    }

    public function getTitle(): string
    {
        return 'Data Kelas';
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }
}
