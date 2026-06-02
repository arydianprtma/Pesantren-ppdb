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

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationLabel = 'Tahun Ajaran (PPDB)';
    
    protected static ?string $modelLabel = 'Tahun Ajaran';
    
    protected static ?string $pluralModelLabel = 'Tahun Ajaran (PPDB)';
    
    protected static ?int $navigationSort = 2;
    
    public static function getNavigationGroup(): ?string
    {
        return 'Sistem';
    }

    public static function canCreate(): bool
    {
        return static::getModel()::count() < 1;
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
                        DateTimePicker::make('tgl_buka')
                            ->label('Tanggal Buka')
                            ->native(true)
                            ->seconds(false)
                            ->required(),
                        DateTimePicker::make('tgl_tutup')
                            ->label('Tanggal Tutup')
                            ->native(true)
                            ->seconds(false)
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->required(),
                        Textarea::make('pesan_tutup')
                            ->label('Pesan Penutupan')
                            ->placeholder('Pesan yang muncul jika pendaftaran sedang ditutup...')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Pengaturan Kop Kartu Pendaftaran')
                    ->description('Sesuaikan teks dan logo yang muncul pada kop/header kartu bukti pendaftaran.')
                    ->schema([
                        FileUpload::make('kartu_logo')
                            ->label('Logo Kop Surat')
                            ->image()
                            ->disk('public')
                            ->directory('logo-kartu')
                            ->imagePreviewHeight('80')
                            ->maxSize(2048)
                            ->helperText('Upload logo untuk kop surat kartu pendaftaran (maks 2MB). Kosongkan untuk gunakan logo default.')
                            ->columnSpanFull(),
                        TextInput::make('kartu_header_1')
                            ->label('Header 1 (Nama Panitia)')
                            ->placeholder('Contoh: Panitia Penerimaan Santri Baru (PSB)')
                            ->maxLength(255),
                        TextInput::make('kartu_header_2')
                            ->label('Header 2 (Nama Lembaga)')
                            ->placeholder('Contoh: Pondok Pesantren Riyadussalikin')
                            ->maxLength(255),
                        TextInput::make('kartu_alamat')
                            ->label('Alamat / Subtitle')
                            ->placeholder('Contoh: Padaherang, Kabupaten Pangandaran, Jawa Barat')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2),
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
                EditAction::make(),
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
