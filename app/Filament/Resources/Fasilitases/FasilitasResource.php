<?php

namespace App\Filament\Resources\Fasilitases;

use App\Filament\Resources\Concerns\ContentManagerAccess;
use App\Filament\Resources\Fasilitases\Pages\CreateFasilitas;
use App\Filament\Resources\Fasilitases\Pages\EditFasilitas;
use App\Filament\Resources\Fasilitases\Pages\ListFasilitases;
use App\Filament\Resources\Fasilitases\Schemas\FasilitasForm;
use App\Filament\Resources\Fasilitases\Tables\FasilitasesTable;
use App\Models\Fasilitas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FasilitasResource extends Resource
{
    use ContentManagerAccess;
    protected static ?string $model = Fasilitas::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Fasilitas';

    protected static ?string $modelLabel = 'Fasilitas';

    protected static ?string $pluralModelLabel = 'Fasilitas';

    protected static ?string $slug = 'fasilitas';

    protected static ?int $navigationSort = 2;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Web';

    public static function form(Schema $schema): Schema
    {
        return FasilitasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FasilitasesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListFasilitases::route('/'),
            'create' => CreateFasilitas::route('/create'),
            'edit'   => EditFasilitas::route('/{record}/edit'),
        ];
    }
}
