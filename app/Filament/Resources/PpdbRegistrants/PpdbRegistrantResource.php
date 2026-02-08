<?php

namespace App\Filament\Resources\PpdbRegistrants;

use App\Filament\Resources\PpdbRegistrants\Pages\CreatePpdbRegistrant;
use App\Filament\Resources\PpdbRegistrants\Pages\EditPpdbRegistrant;
use App\Filament\Resources\PpdbRegistrants\Pages\ListPpdbRegistrants;
use App\Filament\Resources\PpdbRegistrants\Schemas\PpdbRegistrantForm;
use App\Filament\Resources\PpdbRegistrants\Tables\PpdbRegistrantsTable;
use App\Models\PpdbRegistrant;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PpdbRegistrantResource extends Resource
{
    protected static ?string $model = PpdbRegistrant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Pendaftar PPDB';

    protected static ?string $pluralModelLabel = 'Pendaftar PPDB';

    protected static ?string $navigationLabel = 'Pendaftar PPDB';

    protected static ?string $slug = 'ppdb';

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
            'edit' => EditPpdbRegistrant::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasPermission('manage_ppdb') ?? false;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
