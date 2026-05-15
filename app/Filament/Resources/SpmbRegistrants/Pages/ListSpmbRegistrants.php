<?php

namespace App\Filament\Resources\SpmbRegistrants\Pages;

use App\Filament\Resources\SpmbRegistrants\SpmbRegistrantResource;
use App\Models\SpmbPendaftaran;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSpmbRegistrants extends ListRecords
{
    protected static string $resource = SpmbRegistrantResource::class;

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
                ->badge(SpmbPendaftaran::where('status', 'pending')->count())
                ->badgeColor('gray'),

            'jadwal_tes' => Tab::make('Jadwal Tes')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'jadwal_tes'))
                ->badge(SpmbPendaftaran::where('status', 'jadwal_tes')->count())
                ->badgeColor('info'),

            'tes_berlangsung' => Tab::make('Tes Berlangsung')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'tes_berlangsung'))
                ->badge(SpmbPendaftaran::where('status', 'tes_berlangsung')->count())
                ->badgeColor('warning'),

            'wawancara' => Tab::make('Wawancara')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'wawancara'))
                ->badge(SpmbPendaftaran::where('status', 'wawancara')->count())
                ->badgeColor('purple'),

            'diterima' => Tab::make('Diterima')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereIn('status', ['diterima_ula', 'diterima_wustho', 'diterima_ulya']))
                ->badge(SpmbPendaftaran::whereIn('status', ['diterima_ula', 'diterima_wustho', 'diterima_ulya'])->count())
                ->badgeColor('success'),

            'ditolak' => Tab::make('Tidak Diterima')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'ditolak'))
                ->badge(SpmbPendaftaran::where('status', 'ditolak')->count())
                ->badgeColor('danger'),
        ];
    }
}
