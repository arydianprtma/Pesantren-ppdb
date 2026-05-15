<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
// use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class TahunAjaran extends Page
{
    // use HasPageShield;

    protected string $view = 'filament.pages.coming-soon';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-calendar-days';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function getNavigationLabel(): string
    {
        return 'Tahun Ajaran';
    }

    public function getTitle(): string
    {
        return 'Tahun Ajaran';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }
}
