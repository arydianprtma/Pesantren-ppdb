<?php

namespace App\Filament\Resources\Ekstrakurikulers;

use App\Filament\Resources\Ekstrakurikulers\Pages\CreateEkstrakurikuler;
use App\Filament\Resources\Ekstrakurikulers\Pages\EditEkstrakurikuler;
use App\Filament\Resources\Ekstrakurikulers\Pages\ListEkstrakurikulers;
use App\Filament\Resources\Ekstrakurikulers\Schemas\EkstrakurikulerForm;
use App\Filament\Resources\Ekstrakurikulers\Tables\EkstrakurikulerTable;
use App\Models\Ekstrakurikuler;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class EkstrakurikulerResource extends Resource
{
    protected static ?string $model = Ekstrakurikuler::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationLabel = 'Ekstrakurikuler';

    protected static ?string $modelLabel = 'Ekstrakurikuler';

    protected static ?string $pluralModelLabel = 'Ekstrakurikuler';

    protected static ?string $slug = 'ekstrakurikuler';

    protected static ?int $navigationSort = 6;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Web';

    public static function form(Schema $schema): Schema
    {
        return EkstrakurikulerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EkstrakurikulerTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEkstrakurikulers::route('/'),
            'create' => CreateEkstrakurikuler::route('/create'),
            'edit' => EditEkstrakurikuler::route('/{record}/edit'),
        ];
    }
}
