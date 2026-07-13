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

        // Registrasi GeneralActivityObserver untuk modul konten dan pengaturan lainnya
        $modelsToLog = [
            \App\Models\Agenda::class,
            \App\Models\Berita::class,
            \App\Models\Ekstrakurikuler::class,
            \App\Models\Fasilitas::class,
            \App\Models\Kelas::class,
            \App\Models\Prestasi::class,
            \App\Models\Sejarah::class,
            \App\Models\VisiMisi::class,
            \App\Models\WebSetting::class,
            \App\Models\PpdbSetting::class,
            \App\Models\User::class,
        ];

        foreach ($modelsToLog as $model) {
            if (class_exists($model)) {
                $model::observe(\App\Observers\GeneralActivityObserver::class);
            }
        }

        // Catat log login dan logout Administrator secara otomatis
        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\Login::class,
            function ($event) {
                if ($event->user && ($event->user->hasAnyRole(['admin', 'super_admin']) || ($event->user->role ?? null) === 'admin' || ($event->user->role ?? null) === 'super_admin')) {
                    \App\Models\AdminActivityLog::catat(
                        modul: 'auth',
                        aksi: 'login',
                        deskripsi: "Admin \"{$event->user->name}\" masuk ke sistem",
                    );
                }
            }
        );

        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\Logout::class,
            function ($event) {
                if ($event->user && ($event->user->hasAnyRole(['admin', 'super_admin']) || ($event->user->role ?? null) === 'admin' || ($event->user->role ?? null) === 'super_admin')) {
                    \App\Models\AdminActivityLog::catat(
                        modul: 'auth',
                        aksi: 'logout',
                        deskripsi: "Admin \"{$event->user->name}\" keluar dari sistem",
                    );
                }
            }
        );

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
