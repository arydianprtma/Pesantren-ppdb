<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PortalPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('portal')
            ->path('portal')
            ->login()
            ->passwordReset()
            ->emailVerification()
            ->profile(\App\Filament\Pages\Auth\EditProfile::class, isSimple: false)
            ->spa() // Increase performance
            ->databaseNotifications()
            ->databaseNotificationsPolling('10s')
            ->colors([
                'primary' => Color::Emerald,
                'gray' => Color::Slate,
            ])
            ->defaultThemeMode(ThemeMode::Light)
            ->font('Poppins')
            ->brandName('Portal Pesantren')
            ->favicon(asset('Logo Riyad.png'))
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverPages(in: app_path('Filament/Resources/SpmbRegistrants/Pages'), for: 'App\\Filament\\Resources\\SpmbRegistrants\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->navigationGroups([
                'Sistem',
                'Master Data',
                'Manajemen Web',
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // AccountWidget removed for better design
            ])
            ->middleware([
                \App\Http\Middleware\TrustProxies::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->renderHook(
                'panels::body.start',
                fn (): string => config('app.debug') && config('app.env') !== 'local'
                    ? \Illuminate\Support\Facades\Blade::render('<div class="bg-danger-600 text-white text-center py-2 px-4 font-bold">WARNING: APP_DEBUG is enabled in a non-local environment! Disable it in .env for security.</div>')
                    : ''
            )
            ->renderHook(
                'panels::body.end',
                fn (): string => \Illuminate\Support\Facades\Blade::render("
                    <script data-navigate-once>
                        if (typeof window.isFormDirty === 'undefined') {
                            window.isFormDirty = false;
                            
                            document.addEventListener('input', () => { window.isFormDirty = true; });
                            document.addEventListener('change', () => { window.isFormDirty = true; });
                            document.addEventListener('click', (e) => {
                                if (e.target.closest('button[type=\"submit\"]')) { window.isFormDirty = false; }
                            });

                            // CUSTOM MODAL UNTUK PINDAH MENU (Internal Dashboard)
                            document.addEventListener('livewire:navigate', (event) => {
                                if (window.isFormDirty) {
                                    event.preventDefault();
                                    
                                    // Memanggil sistem notifikasi Filament secara paksa
                                    window.dispatchEvent(new CustomEvent('open-modal', { 
                                        detail: { 
                                            id: 'confirm-leave-modal' 
                                        } 
                                    }));
                                    
                                    // Simpan URL tujuan
                                    window.pendingNavigationUrl = event.detail.url;
                                }
                            });
                        }
                    </script>

                    <x-filament::modal id=\"confirm-leave-modal\" icon=\"heroicon-o-exclamation-triangle\" icon-color=\"warning\" alignment=\"center\">
                        <x-slot name=\"heading\">
                            Perubahan Belum Disimpan
                        </x-slot>

                        <x-slot name=\"description\">
                            Apakah Anda yakin ingin meninggalkan halaman ini? Semua perubahan yang belum disimpan akan hilang.
                        </x-slot>

                        <div class=\"flex justify-center gap-3\">
                            <x-filament::button color=\"gray\" x-on:click=\"close()\">
                                Batal
                            </x-filament::button>

                            <x-filament::button color=\"warning\" x-on:click=\"window.location.href = window.pendingNavigationUrl\">
                                Tinggalkan
                            </x-filament::button>
                        </div>
                    </x-filament::modal>
                ")
            )
            ->authMiddleware([
                Authenticate::class,
                'throttle:admin',
            ])
            ->renderHook(
                'panels::head.end',
                fn() => view('filament.custom-styles')
            )
            ->renderHook(
                'panels::head.end',
                fn() => view('filament.custom-sidebar-styles')
            )
            ->renderHook(
                'panels::scripts.end',
                fn() => view('filament.custom-sidebar-scripts')
            );
    }
}
