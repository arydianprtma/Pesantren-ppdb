<?php

namespace App\Filament\Resources;


use Illuminate\Support\Facades\Auth;
use Filament\Resources\Resource;

class UserResource extends Resource
{
    protected static ?string $model = \App\Models\User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Manajemen User';

    protected static ?string $modelLabel = 'User';

    protected static ?string $pluralModelLabel = 'Manajemen User';

    protected static ?string $slug = 'manajemen-user';

    protected static ?int $navigationSort = 3;

    protected static string|\UnitEnum|null $navigationGroup = 'Sistem';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('role', '!=', 'siswa');
    }

    public static function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Informasi Akun')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->image()
                            ->avatar()
                            ->imageResizeTargetWidth(300)
                            ->imageResizeTargetHeight(300)
                            ->directory('avatars')
                            ->maxSize(4096) // 4MB
                            ->columnSpanFull()
                            ->helperText('Maksimal 4MB. Foto akan di-resize otomatis.'),
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->minLength(8)
                            ->helperText('Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.'),
                    ])
                    ->columns(2),

                \Filament\Schemas\Components\Section::make('Hak Akses')
                    ->schema([
                        \Filament\Forms\Components\Select::make('role')
                            ->label('Role')
                            ->options([
                                'super_admin' => 'Super Admin',
                                'admin' => 'Admin',
                                'editor' => 'Editor',
                            ])
                            ->default('admin')
                            ->required()
                            ->live(),
                        \Filament\Forms\Components\CheckboxList::make('permissions')
                            ->label('Hak Akses Khusus')
                            ->options(\App\Models\User::availablePermissions())
                            ->columns(2)
                            ->visible(fn($get) => $get('role') !== 'super_admin')
                            ->helperText('Super Admin memiliki akses ke semua fitur secara otomatis.'),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('User yang tidak aktif tidak dapat login ke panel admin.'),
                    ]),
            ]);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->poll('10s')
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=10b981&background=d1fae5'),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'admin' => 'warning',
                        'editor' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'super_admin' => 'Super Admin',
                        'admin' => 'Admin',
                        'editor' => 'Editor',
                        default => $state,
                    }),
                \Filament\Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('role')
                    ->label('Role')
                    ->options([
                        'super_admin' => 'Super Admin',
                        'admin' => 'Admin',
                        'editor' => 'Editor',
                    ]),
                \Filament\Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Tidak Aktif',
                    ]),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make()
                    ->visible(fn(\App\Models\User $record) => $record->getKey() !== Auth::id()),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \App\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
            'edit' => \App\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }

    /**
     * Hanya Super Admin yang bisa mengakses Manajemen User
     */
    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        return $user?->isSuperAdmin() ?? false;
    }

    /**
     * Hanya Super Admin yang bisa membuat user baru
     */
    public static function canCreate(): bool
    {
        return static::canAccess();
    }

    /**
     * Hanya Super Admin yang bisa mengedit user.
     * Super Admin tidak bisa mengedit dirinya sendiri dari sini (gunakan profile).
     */
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return static::canAccess();
    }

    /**
     * Hanya Super Admin yang bisa menghapus user.
     * Tidak bisa menghapus diri sendiri atau sesama Super Admin.
     */
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        /** @var \App\Models\User|null $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user?->isSuperAdmin()) {
            return false;
        }
        // Tidak bisa hapus diri sendiri
        if ($record->getKey() === $user->getKey()) {
            return false;
        }
        // Tidak bisa hapus sesama Super Admin
        if ($record->role === 'super_admin') {
            return false;
        }
        return true;
    }
}
