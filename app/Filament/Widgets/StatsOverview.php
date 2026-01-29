<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\PpdbRegistrant;
use App\Models\Prestasi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2; // Di bawah jam

    protected function getStats(): array
    {
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

            Stat::make('Total Pendaftar PPDB', PpdbRegistrant::count())
                ->description('Total siswa mendaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([10, 15, 8, 12, 11, 14, PpdbRegistrant::count()]),

            Stat::make('Pendaftar Hari Ini', PpdbRegistrant::whereDate('created_at', today())->count())
                ->description('Mendaftar hari ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
