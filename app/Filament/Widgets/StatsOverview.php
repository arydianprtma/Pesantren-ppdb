<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\PpdbPendaftaran;
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

        $activeSetting = \App\Models\PpdbSetting::where('is_active', true)->first();
        $tahunAjaran = $activeSetting ? $activeSetting->tahun_ajaran : null;
        $taLabel = $tahunAjaran ? " (TA {$tahunAjaran})" : "";

        $totalPendaftar = PpdbPendaftaran::query();
        $smpPendaftar = PpdbPendaftaran::where('tingkat', 'smp');
        $smaPendaftar = PpdbPendaftaran::where('tingkat', 'sma');
        $hariIniPendaftar = PpdbPendaftaran::whereDate('created_at', today());
        $kemarinPendaftar = PpdbPendaftaran::whereDate('created_at', today()->subDay());

        $hasTahunAjaran = \Illuminate\Support\Facades\Schema::hasColumn('ppdb_pendaftaran', 'tahun_ajaran');

        if ($tahunAjaran && $hasTahunAjaran) {
            $totalPendaftar->where('tahun_ajaran', $tahunAjaran);
            $smpPendaftar->where('tahun_ajaran', $tahunAjaran);
            $smaPendaftar->where('tahun_ajaran', $tahunAjaran);
            $hariIniPendaftar->where('tahun_ajaran', $tahunAjaran);
            $kemarinPendaftar->where('tahun_ajaran', $tahunAjaran);
        }

        $totalCount = $totalPendaftar->count();
        $smpCount = $smpPendaftar->count();
        $smaCount = $smaPendaftar->count();
        $hariIniCount = $hariIniPendaftar->count();
        $kemarinCount = $kemarinPendaftar->count();

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

            Stat::make('Total Pendaftar PPDB' . $taLabel, $totalCount)
                ->description('Siswa mendaftar' . $taLabel)
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([10, 15, 8, 12, 11, 14, $totalCount]),

            Stat::make('Pendaftar SMP' . $taLabel, $smpCount)
                ->description('Siswa tingkat SMP' . $taLabel)
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Pendaftar SMA' . $taLabel, $smaCount)
                ->description('Siswa tingkat SMA' . $taLabel)
                ->descriptionIcon('heroicon-m-building-office')
                ->color('info'),

            Stat::make('Pendaftar Hari Ini' . $taLabel, $hariIniCount)
                ->description('Kemarin: ' . $kemarinCount . ' pendaftar')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
