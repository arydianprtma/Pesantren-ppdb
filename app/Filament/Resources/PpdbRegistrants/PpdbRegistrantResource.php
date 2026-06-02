<?php

namespace App\Filament\Resources\PpdbRegistrants;

use App\Filament\Resources\Concerns\AdminOnlyAccess;
use App\Filament\Resources\PpdbRegistrants\Pages\CreatePpdbRegistrant;
use App\Filament\Resources\PpdbRegistrants\Pages\EditPpdbRegistrant;
use App\Filament\Resources\PpdbRegistrants\Pages\ListPpdbRegistrants;
use App\Filament\Resources\PpdbRegistrants\Pages\ScanQR;
use App\Filament\Resources\PpdbRegistrants\Schemas\PpdbRegistrantForm;
use App\Filament\Resources\PpdbRegistrants\Tables\PpdbRegistrantsTable;
use App\Models\PpdbPendaftaran;
use Filament\Resources\Resource;
use Filament\Navigation\NavigationItem;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PpdbRegistrantResource extends Resource
{
    use AdminOnlyAccess;

    protected static ?string $model = PpdbPendaftaran::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $modelLabel = 'Pendaftar PPDB';

    protected static ?string $pluralModelLabel = 'Pendaftaran PPDB';

    protected static ?string $navigationLabel = 'Pendaftaran PPDB';

    protected static string|\UnitEnum|null $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'ppdb';

    public static function getNavigationGroup(): ?string
    {
        return 'Sistem';
    }

    public static function getNavigationItems(): array
    {
        return [
            ...parent::getNavigationItems(),
            NavigationItem::make('Scan Verifikasi')
                ->group('Sistem')
                ->icon('heroicon-o-qr-code')
                ->activeIcon('heroicon-s-qr-code')
                ->isActiveWhen(fn () => request()->routeIs('filament.portal.resources.ppdb.scan'))
                ->url(static::getUrl('scan'))
                ->sort(4),
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return PpdbRegistrantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PpdbRegistrantsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPpdbRegistrants::route('/'),
            'create' => CreatePpdbRegistrant::route('/create'),
            'scan' => ScanQR::route('/scan'),
            'edit' => EditPpdbRegistrant::route('/{record}/edit'),
        ];
    }


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function getNavigationBadgePollingInterval(): ?string
    {
        return '10s';
    }
}
