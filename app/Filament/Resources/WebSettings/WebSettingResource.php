<?php

namespace App\Filament\Resources\WebSettings;

use App\Filament\Resources\Concerns\AdminOnlyAccess;
use App\Filament\Resources\WebSettings\Pages\ManageWebSettings;
use App\Models\WebSetting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WebSettingResource extends Resource
{
    use AdminOnlyAccess;

    protected static ?string $model = WebSetting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Web';

    protected static ?string $modelLabel = 'Pengaturan Web';

    protected static ?string $pluralModelLabel = 'Pengaturan Web';

    protected static ?string $slug = 'pengaturan-web';

    protected static ?int $navigationSort = 8;

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Web';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Fitur Virtual Tour')
                    ->description('Kelola tampilan fitur Virtual Tour di halaman Fasilitas.')
                    ->schema([
                        Toggle::make('is_virtual_tour_active')
                            ->label('Aktifkan Virtual Tour')
                            ->helperText('Jika dinonaktifkan, bagian Virtual Tour tidak akan muncul di website.')
                            ->inline(false)
                            ->default(true),
                        TextInput::make('virtual_tour_url')
                            ->label('URL Video Virtual Tour')
                            ->placeholder('https://www.youtube.com/embed/...')
                            ->helperText('Masukkan URL embed video (YouTube/Vimeo).')
                            ->url(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                \Filament\Schemas\Components\Section::make('Media Sosial')
                    ->description('Kelola link media sosial pondok pesantren.')
                    ->collapsible()
                    ->schema([
                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->placeholder('https://facebook.com/...')
                            ->url(),
                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('https://instagram.com/...')
                            ->url(),
                        TextInput::make('tiktok')
                            ->label('TikTok')
                            ->placeholder('https://tiktok.com/@...')
                            ->url(),
                        TextInput::make('youtube')
                            ->label('YouTube')
                            ->placeholder('https://youtube.com/c/...')
                            ->url(),
                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->placeholder('081234567890')
                            ->tel(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                \Filament\Schemas\Components\Section::make('Statistik Pondok')
                    ->description('Kelola data statistik yang ditampilkan di beranda dan halaman tentang pondok.')
                    ->collapsible()
                    ->schema([
                        TextInput::make('base_santri_aktif')
                            ->label('Base Santri Aktif')
                            ->helperText('Jumlah santri aktif awal (akan ditambah otomatis dengan jumlah pendaftar yang diterima).')
                            ->numeric()
                            ->default(0),
                        TextInput::make('jml_unit_sekolah')
                            ->label('Jumlah Unit Sekolah')
                            ->numeric()
                            ->default(0),
                        TextInput::make('akreditasi')
                            ->label('Akreditasi')
                            ->placeholder('A')
                            ->default('A'),
                        TextInput::make('persentase_kelulusan')
                            ->label('Persentase Kelulusan')
                            ->placeholder('100%')
                            ->default('100%'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                IconEntry::make('is_virtual_tour_active')
                    ->boolean(),
                TextEntry::make('virtual_tour_url')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_virtual_tour_active')
                    ->label('Virtual Tour Aktif')
                    ->boolean(),
                TextColumn::make('virtual_tour_url')
                    ->label('URL Video')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->modalWidth('3xl'),
                EditAction::make()->modalWidth('3xl'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageWebSettings::route('/'),
        ];
    }
}
