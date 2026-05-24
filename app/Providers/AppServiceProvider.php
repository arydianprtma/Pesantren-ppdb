<?php

namespace App\Providers;

use App\Models\Guru;
use App\Models\SpmbPendaftaran;
use App\Observers\GuruObserver;
use App\Observers\SpmbPendaftaranObserver;
use App\Observers\SpmbRegistrantObserver;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        SpmbPendaftaran::observe(SpmbRegistrantObserver::class);
        SpmbPendaftaran::observe(SpmbPendaftaranObserver::class);
        Guru::observe(GuruObserver::class);

        if (isset($_SERVER['HTTP_HOST']) && (str_starts_with($_SERVER['HTTP_HOST'], '192.168.') || $_SERVER['HTTP_HOST'] === 'localhost' || str_starts_with($_SERVER['HTTP_HOST'], '127.0.0.1'))) {
            $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
            \Illuminate\Support\Facades\URL::forceRootUrl($scheme . '://' . $_SERVER['HTTP_HOST']);
        }

        // Batasi ukuran unggahan File/Image secara global di Filament menjadi 4MB
        \Filament\Forms\Components\FileUpload::configureUsing(function (\Filament\Forms\Components\FileUpload $component) {
            $component->maxSize(4096);
        });
    }
}
