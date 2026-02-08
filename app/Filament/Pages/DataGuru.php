<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataGuru extends Page
{
    protected string $view = 'filament.pages.coming-soon';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-academic-cap';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Guru';
    }

    public function getTitle(): string
    {
        return 'Data Guru';
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }
}
