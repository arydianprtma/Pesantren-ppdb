<?php

namespace App\Filament\Resources\SpmbRegistrants\Pages;

use App\Filament\Resources\SpmbRegistrants\SpmbRegistrantResource;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Resources\Pages\Page;

class ScanQR extends Page
{
    // Hapus HasPageShield sepenuhnya untuk menghindari Fatal Error
    // use HasPageShield;

    public function mount(): void
    {
        // Cek manual akses menggunakan logic Resource
        if (!static::getResource()::canAccess()) {
            abort(403);
        }
    }

    /**
     * @param  array<string, mixed>  $parameters
     * @return bool
     */
    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        try {
            return static::getResource()::canAccess();
        } catch (\Throwable $e) {
            return false;
        }
    }

    protected static string $resource = SpmbRegistrantResource::class;

    protected string $view = 'filament.resources.ppdb.pages.scan-qr';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Scan Verifikasi';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-qr-code';

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return 'Sistem';
    }
}