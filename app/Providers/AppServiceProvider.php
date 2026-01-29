<?php

namespace App\Providers;

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
        \App\Models\Prestasi::observe(\App\Observers\PrestasiObserver::class);
        \App\Models\ContactMessage::observe(\App\Observers\ContactMessageObserver::class);
    }
}
