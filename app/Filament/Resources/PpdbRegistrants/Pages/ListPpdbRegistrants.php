<?php

namespace App\Filament\Resources\PpdbRegistrants\Pages;

use App\Filament\Resources\PpdbRegistrants\PpdbRegistrantResource;
use App\Models\PpdbPendaftaran;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

use Livewire\Attributes\Url;

class ListPpdbRegistrants extends ListRecords
{
    protected static string $resource = PpdbRegistrantResource::class;

    #[Url]
    public ?array $tableFilters = null;

    #[Url]
    public ?string $tableSortColumn = null;

    #[Url]
    public ?string $tableSortDirection = null;

    #[Url]
    public $tableSearch = '';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua'),

            'pending' => Tab::make('Menunggu Verifikasi')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'pending'))
                ->badge(PpdbPendaftaran::where('status', 'pending')->count())
                ->badgeColor('gray'),

            'jadwal_tes' => Tab::make('Jadwal Tes')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'jadwal_tes'))
                ->badge(PpdbPendaftaran::where('status', 'jadwal_tes')->count())
                ->badgeColor('info'),

            'tes_berlangsung' => Tab::make('Tes Berlangsung')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'tes_berlangsung'))
                ->badge(PpdbPendaftaran::where('status', 'tes_berlangsung')->count())
                ->badgeColor('warning'),

            'wawancara' => Tab::make('Wawancara')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'wawancara'))
                ->badge(PpdbPendaftaran::where('status', 'wawancara')->count())
                ->badgeColor('purple'),

            'diterima' => Tab::make('Diterima')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereIn('status', ['diterima_ula', 'diterima_idadiyah', 'diterima_wustho', 'diterima_ulya']))
                ->badge(PpdbPendaftaran::whereIn('status', ['diterima_ula', 'diterima_idadiyah', 'diterima_wustho', 'diterima_ulya'])->count())
                ->badgeColor('success'),

            'ditolak' => Tab::make('Tidak Diterima')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'ditolak'))
                ->badge(PpdbPendaftaran::where('status', 'ditolak')->count())
                ->badgeColor('danger'),
        ];
    }
}
