<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class DataSantri extends Page
{
    protected string $view = 'filament.pages.coming-soon';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-identification';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function getNavigationLabel(): string
    {
        return 'Data Santri';
    }

    public function getTitle(): string
    {
        return 'Data Santri Pondok';
    }

    public static function getNavigationSort(): ?int
    {
        return 7;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }
}
