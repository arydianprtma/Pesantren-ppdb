<?php

namespace App\Providers;

use App\Models\SpmbPendaftaran;
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

        if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === '192.168.1.7:8080') {
            \Illuminate\Support\Facades\URL::forceRootUrl('http://192.168.1.7:8080');
        }
    }
}
