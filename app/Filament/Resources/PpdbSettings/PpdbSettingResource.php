<?php

namespace App\Filament\Resources\PpdbSettings;

use App\Filament\Resources\Concerns\AdminOnlyAccess;
use App\Filament\Resources\PpdbSettings\Pages\ManagePpdbSettings;
use App\Models\PpdbSetting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class PpdbSettingResource extends Resource
{
    use AdminOnlyAccess;

    protected static ?string $model = PpdbSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';
    
    protected static ?string $navigationLabel = 'Tahun Ajaran SPMB';
    
    protected static ?string $modelLabel = 'Tahun Ajaran';
    
    protected static ?string $pluralModelLabel = 'Tahun Ajaran SPMB';
    
    protected static ?int $navigationSort = 2;
    
    public static function getNavigationGroup(): ?string
    {
        return 'Sistem';
    }



    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Periode Pendaftaran')
                    ->description('Atur kapan pendaftaran santri baru dibuka dan ditutup.')
                    ->schema([
                        TextInput::make('tahun_ajaran')
                            ->label('Tahun Ajaran')
                            ->placeholder('Contoh: 2026/2027')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->inline(false)
                            ->required(),
                        DateTimePicker::make('tgl_buka')
                            ->label('Tanggal Buka')
                            ->native(false)
                            ->seconds(false)
                            ->required(),
                        DateTimePicker::make('tgl_tutup')
                            ->label('Tanggal Tutup')
                            ->native(false)
                            ->seconds(false)
                            ->required(),
                        Textarea::make('pesan_tutup')
                            ->label('Pesan Penutupan')
                            ->placeholder('Pesan yang muncul jika pendaftaran sedang ditutup...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('smp_count')
                    ->label('Pendaftar SMP')
                    ->getStateUsing(fn ($record) => \App\Models\PpdbPendaftaran::where('tahun_ajaran', $record->tahun_ajaran)->where('tingkat', 'smp')->count())
                    ->url(fn ($record) => route('filament.portal.resources.ppdb.index', [
                        'tableFilters[tahun_ajaran][value]' => $record->tahun_ajaran,
                        'tableFilters[tingkat][value]' => 'smp',
                    ]))
                    ->color('primary'),
                TextColumn::make('sma_count')
                    ->label('Pendaftar SMA')
                    ->getStateUsing(fn ($record) => \App\Models\PpdbPendaftaran::where('tahun_ajaran', $record->tahun_ajaran)->where('tingkat', 'sma')->count())
                    ->url(fn ($record) => route('filament.portal.resources.ppdb.index', [
                        'tableFilters[tahun_ajaran][value]' => $record->tahun_ajaran,
                        'tableFilters[tingkat][value]' => 'sma',
                    ]))
                    ->color('primary'),
                TextColumn::make('total_count')
                    ->label('Total Pendaftar')
                    ->getStateUsing(fn ($record) => \App\Models\PpdbPendaftaran::where('tahun_ajaran', $record->tahun_ajaran)->count())
                    ->url(fn ($record) => route('filament.portal.resources.ppdb.index', [
                        'tableFilters[tahun_ajaran][value]' => $record->tahun_ajaran,
                    ]))
                    ->weight('bold')
                    ->color('success'),
                TextColumn::make('tgl_buka')
                    ->label('Buka')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('tgl_tutup')
                    ->label('Tutup')
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->modalWidth('2xl'),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePpdbSettings::route('/'),
        ];
    }
}
