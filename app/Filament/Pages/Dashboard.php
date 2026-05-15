<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title = 'Beranda';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';

    public static function getNavigationLabel(): string
    {
        return 'Beranda';
    }
}
