<?php

namespace App\Filament\Resources\PpdbRegistrants\Pages;

use App\Filament\Resources\PpdbRegistrants\PpdbRegistrantResource;
use App\Models\PpdbRegistrant;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPpdbRegistrants extends ListRecords
{
    protected static string $resource = PpdbRegistrantResource::class;

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
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'pending'))
                ->badge(PpdbRegistrant::where('status', 'pending')->count())
                ->badgeColor('gray'),
            'verified' => Tab::make('Verified')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'verified'))
                ->badge(PpdbRegistrant::where('status', 'verified')->count())
                ->badgeColor('info'),
            'accepted' => Tab::make('Accepted')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'accepted'))
                ->badge(PpdbRegistrant::where('status', 'accepted')->count())
                ->badgeColor('success'),
            'rejected' => Tab::make('Rejected')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'rejected'))
                ->badge(PpdbRegistrant::where('status', 'rejected')->count())
                ->badgeColor('danger'),
        ];
    }
}
