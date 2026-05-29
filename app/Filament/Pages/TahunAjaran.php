<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Concerns\AdminOnlyAccess;
use Filament\Pages\Page;
// use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class TahunAjaran extends Page
{
    use AdminOnlyAccess;
    // use HasPageShield;

    protected string $view = 'filament.pages.coming-soon';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-calendar-days';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Sistem';
    }

    public static function getNavigationLabel(): string
    {
        return 'Tahun Ajaran PPDB';
    }

    public function getTitle(): string
    {
        return 'Tahun Ajaran PPDB';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

}
