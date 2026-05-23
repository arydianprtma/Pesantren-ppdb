<?php

namespace App\Filament\Resources\Berita;

use App\Filament\Resources\Concerns\ContentManagerAccess;
use App\Filament\Resources\Berita\Pages\CreateBerita;
use App\Filament\Resources\Berita\Pages\EditBerita;
use App\Filament\Resources\Berita\Pages\ListBerita;
use App\Filament\Resources\Berita\Schemas\BeritaForm;
use App\Filament\Resources\Berita\Tables\BeritaTable;
use App\Models\Berita;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class BeritaResource extends Resource
{
    use ContentManagerAccess;

    protected static ?string $permission = 'manage_berita';

    protected static ?string $model = Berita::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Berita';

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Web';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Berita';

    protected static ?string $pluralModelLabel = 'Berita';

    protected static ?string $slug = 'berita';

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return BeritaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BeritaTable::configure($table);
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
            'index' => ListBerita::route('/'),
            'create' => CreateBerita::route('/create'),
            'edit' => EditBerita::route('/{record}/edit'),
        ];
    }

}
