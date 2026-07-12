<?php

namespace App\Filament\Resources\Kelas;

use App\Filament\Resources\Concerns\AdminOnlyAccess;
use App\Filament\Resources\Kelas\Pages\CreateKelas;
use App\Filament\Resources\Kelas\Pages\EditKelas;
use App\Filament\Resources\Kelas\Pages\ListKelas;
use App\Filament\Resources\Kelas\Schemas\KelasForm;
use App\Filament\Resources\Kelas\Tables\KelasTable;
use App\Models\Kelas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class KelasResource extends Resource
{
    use AdminOnlyAccess;

    protected static ?string $model = Kelas::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Data Kelas';

    protected static ?string $modelLabel = 'Data Kelas';

    protected static ?string $pluralModelLabel = 'Data Kelas';

    protected static ?string $slug = 'data-kelas';

    protected static ?int $navigationSort = 2;

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    public static function form(Schema $schema): Schema
    {
        return KelasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KelasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PendaftaransRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListKelas::route('/'),
            'create' => CreateKelas::route('/create'),
            'edit'   => EditKelas::route('/{record}/edit'),
        ];
    }
}
