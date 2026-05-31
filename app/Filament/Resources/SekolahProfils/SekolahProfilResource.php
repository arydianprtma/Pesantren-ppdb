<?php

namespace App\Filament\Resources\SekolahProfils;

use App\Filament\Resources\Concerns\ContentManagerAccess;
use App\Filament\Resources\SekolahProfils\Pages\CreateSekolahProfil;
use App\Filament\Resources\SekolahProfils\Pages\EditSekolahProfil;
use App\Filament\Resources\SekolahProfils\Pages\ListSekolahProfils;
use App\Filament\Resources\SekolahProfils\Schemas\SekolahProfilForm;
use App\Filament\Resources\SekolahProfils\Tables\SekolahProfilTable;
use App\Models\SekolahProfil;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SekolahProfilResource extends Resource
{
    use ContentManagerAccess;
    protected static ?string $model = SekolahProfil::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Profil Sekolah (SMP)';

    protected static ?string $modelLabel = 'Profil Sekolah';

    protected static ?string $pluralModelLabel = 'Profil Sekolah';

    protected static ?string $slug = 'sekolah-profil';

    protected static ?int $navigationSort = 6;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Web';

    public static function form(Schema $schema): Schema
    {
        return SekolahProfilForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SekolahProfilTable::configure($table);
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
            'index' => ListSekolahProfils::route('/'),
            'create' => CreateSekolahProfil::route('/create'),
            'edit' => EditSekolahProfil::route('/{record}/edit'),
        ];
    }
}
