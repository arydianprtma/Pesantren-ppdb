<?php

namespace App\Providers;

use App\Models\Guru;
use App\Models\PpdbPendaftaran;
use App\Observers\GuruObserver;
use App\Observers\PpdbPendaftaranObserver;
use App\Observers\PpdbRegistrantObserver;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \Filament\Auth\Notifications\ResetPassword::class,
            \App\Notifications\AdminResetPasswordNotification::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        PpdbPendaftaran::observe(PpdbRegistrantObserver::class);
        PpdbPendaftaran::observe(PpdbPendaftaranObserver::class);
        Guru::observe(GuruObserver::class);

        // Rate Limiter untuk Panel Admin
        RateLimiter::for('admin', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

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
