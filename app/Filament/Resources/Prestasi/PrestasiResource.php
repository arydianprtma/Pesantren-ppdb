<?php

namespace App\Filament\Resources\Prestasi;

use App\Filament\Resources\Prestasi\Pages\CreatePrestasi;
use App\Filament\Resources\Prestasi\Pages\EditPrestasi;
use App\Filament\Resources\Prestasi\Pages\ListPrestasi;
use App\Filament\Resources\Prestasi\Schemas\PrestasiForm;
use App\Filament\Resources\Prestasi\Tables\PrestasiTable;
use App\Models\Prestasi;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationLabel = 'Prestasi';

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Web';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Prestasi';

    protected static ?string $pluralModelLabel = 'Prestasi';

    protected static ?string $slug = 'prestasi';

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return PrestasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrestasiTable::configure($table);
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
            'index' => ListPrestasi::route('/'),
            'create' => CreatePrestasi::route('/create'),
            'edit' => EditPrestasi::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        return $user?->isAdmin() ?? false;
    }
}
