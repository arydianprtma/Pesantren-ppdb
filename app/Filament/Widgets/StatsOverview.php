<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\SpmbPendaftaran;
use App\Models\Prestasi;
use App\Models\Berita;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected ?string $pollingInterval = '10s';
    protected static ?int $sort = 2; // Di bawah jam

    protected function getListeners(): array
    {
        return [
            "echo:pendaftaran,.created" => '$refresh',
            "echo:pendaftaran,.updated" => '$refresh',
        ];
    }

    protected function getStats(): array
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        if ($user?->isEditor()) {
            return [
                Stat::make('Total Berita', Berita::count())
                    ->description('Artikel berita diterbitkan')
                    ->descriptionIcon('heroicon-m-newspaper')
                    ->color('success'),

                Stat::make('Total Prestasi', Prestasi::count())
                    ->description('Prestasi tercatat')
                    ->descriptionIcon('heroicon-m-trophy')
                    ->color('warning'),
            ];
        }

        return [
            Stat::make('Pesan Masuk Baru', ContactMessage::where('is_read', false)->count())
                ->description('Perlu dibaca segera')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Total Prestasi', Prestasi::count())
                ->description('Prestasi tercatat')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('warning'),

            Stat::make('Total Pendaftar PPDB', SpmbPendaftaran::count())
                ->description('Total siswa mendaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([10, 15, 8, 12, 11, 14, SpmbPendaftaran::count()]),

            Stat::make('Pendaftar SMP', SpmbPendaftaran::where('tingkat', 'smp')->count())
                ->description('Siswa tingkat SMP')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Pendaftar SMA', SpmbPendaftaran::where('tingkat', 'sma')->count())
                ->description('Siswa tingkat SMA')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('info'),

            Stat::make('Pendaftar Hari Ini', SpmbPendaftaran::whereDate('created_at', today())->count())
                ->description('Kemarin: ' . SpmbPendaftaran::whereDate('created_at', today()->subDay())->count() . ' pendaftar')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
