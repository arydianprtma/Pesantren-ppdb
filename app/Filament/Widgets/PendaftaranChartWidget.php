<?php

namespace App\Filament\Widgets;

use App\Models\PpdbPendaftaran;
use App\Models\PpdbSetting;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class PendaftaranChartWidget extends ChartWidget
{
    public static function canView(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    protected ?string $heading = 'Grafik Pendaftaran Harian';

    protected static ?int $sort = 3;

    protected ?string $maxHeight = '250px';

    protected int|string|array $columnSpan = 'full';

    protected function getFilters(): ?array
    {
        return PpdbSetting::pluck('tahun_ajaran', 'tahun_ajaran')->toArray();
    }

    protected function getData(): array
    {
        $tahunAjaran = $this->filter;

        if (! $tahunAjaran) {
            $activeSetting = PpdbSetting::where('is_active', true)->first();
            $tahunAjaran = $activeSetting ? $activeSetting->tahun_ajaran : null;

            if (! $tahunAjaran) {
                $latestSetting = PpdbSetting::latest()->first();
                $tahunAjaran = $latestSetting ? $latestSetting->tahun_ajaran : null;
            }

            $this->filter = $tahunAjaran;
        }

        $querySmp = PpdbPendaftaran::where('tingkat', 'smp');
        $querySma = PpdbPendaftaran::where('tingkat', 'sma');
        $hasTahunAjaran = Schema::hasColumn('ppdb_pendaftaran', 'tahun_ajaran');

        if ($tahunAjaran && $hasTahunAjaran) {
            $querySmp->where('tahun_ajaran', $tahunAjaran);
            $querySma->where('tahun_ajaran', $tahunAjaran);
        }

        // Get registrations for the last 15 days of the selected academic year period
        $days = 15;
        $setting = PpdbSetting::where('tahun_ajaran', $tahunAjaran)->first();

        if ($setting && ! $setting->is_active) {
            // Closed/historical academic year: show the final 15 days of its active period
            $endDate = Carbon::parse($setting->tgl_tutup)->endOfDay();
            $startDate = Carbon::parse($setting->tgl_tutup)->subDays($days - 1)->startOfDay();
        } else {
            // Active or default: show last 15 days up to today
            $startDate = now()->subDays($days - 1)->startOfDay();
            $endDate = now()->endOfDay();
        }

        $smpData = $querySmp->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $smaData = $querySma->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $labels = [];
        $smpDataset = [];
        $smaDataset = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = $endDate->copy()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $labelStr = $date->translatedFormat('d M'); // e.g., "06 Jun"
            
            $labels[] = $labelStr;
            $smpDataset[] = $smpData[$dateStr] ?? 0;
            $smaDataset[] = $smaData[$dateStr] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendaftar SMP',
                    'data' => $smpDataset,
                    'borderColor' => '#10b981', // emerald green
                    'backgroundColor' => 'rgba(16, 185, 129, 0.05)',
                    'tension' => 0.4,
                    'fill' => true,
                    'pointBackgroundColor' => '#fff',
                    'pointBorderColor' => '#10b981',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 3,
                    'pointHoverRadius' => 6,
                ],
                [
                    'label' => 'Pendaftar SMA',
                    'data' => $smaDataset,
                    'borderColor' => '#0ea5e9', // sky blue
                    'backgroundColor' => 'rgba(14, 165, 233, 0.05)',
                    'tension' => 0.4,
                    'fill' => true,
                    'pointBackgroundColor' => '#fff',
                    'pointBorderColor' => '#0ea5e9',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 3,
                    'pointHoverRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'boxWidth' => 12,
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'grid' => [
                        'drawBorder' => false,
                        'color' => 'rgba(0, 0, 0, 0.03)',
                    ],
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
