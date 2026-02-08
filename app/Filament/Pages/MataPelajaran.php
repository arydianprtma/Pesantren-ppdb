<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MataPelajaran extends Page
{
    protected string $view = 'filament.pages.coming-soon';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-book-open';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Master Data';
    }

    public static function getNavigationLabel(): string
    {
        return 'Mata Pelajaran';
    }

    public function getTitle(): string
    {
        return 'Mata Pelajaran';
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }
}
