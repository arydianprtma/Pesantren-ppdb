<?php

namespace App\Filament\Resources\SpmbRegistrants;

use App\Filament\Resources\Concerns\AdminOnlyAccess;
use App\Filament\Resources\SpmbRegistrants\Pages\CreateSpmbRegistrant;
use App\Filament\Resources\SpmbRegistrants\Pages\EditSpmbRegistrant;
use App\Filament\Resources\SpmbRegistrants\Pages\ListSpmbRegistrants;
use App\Filament\Resources\SpmbRegistrants\Schemas\SpmbRegistrantForm;
use App\Filament\Resources\SpmbRegistrants\Tables\SpmbRegistrantsTable;
use App\Models\SpmbPendaftaran;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SpmbRegistrantResource extends Resource
{
    use AdminOnlyAccess;

    protected static ?string $model = SpmbPendaftaran::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $modelLabel = 'Pendaftar PPDB';

    protected static ?string $pluralModelLabel = 'Pendaftaran PPDB';

    protected static ?string $navigationLabel = 'Pendaftaran PPDB';

    protected static string|\UnitEnum|null $navigationGroup = 'Sistem';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'ppdb';

    public static function form(Schema $schema): Schema
    {
        return SpmbRegistrantForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpmbRegistrantsTable::configure($table);
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
            'index' => ListSpmbRegistrants::route('/'),
            'create' => CreateSpmbRegistrant::route('/create'),
            'edit' => EditSpmbRegistrant::route('/{record}/edit'),
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
