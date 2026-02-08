<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MataPelajaran extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Mata Pelajaran';

    protected static ?string $title = 'Mata Pelajaran';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.coming-soon';
}
