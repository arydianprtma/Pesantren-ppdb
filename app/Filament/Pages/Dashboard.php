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

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('sendTestNotification')
                ->label('Kirim Notifikasi Uji Coba')
                ->icon('heroicon-o-bell')
                ->color('success')
                ->action(function () {
                    \Filament\Notifications\Notification::make()
                        ->title('Notifikasi Uji Coba')
                        ->body('Ini adalah notifikasi uji coba untuk memverifikasi bahwa sistem notifikasi lonceng Anda aktif.')
                        ->icon('heroicon-o-check-circle')
                        ->iconColor('success')
                        ->sendToDatabase(auth()->user());
                    
                    \Filament\Notifications\Notification::make()
                        ->title('Notifikasi Terkirim')
                        ->body('Notifikasi uji coba berhasil dikirim ke database Anda. Periksa icon lonceng!')
                        ->success()
                        ->send();
                }),
        ];
    }
}
