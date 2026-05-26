<?php

declare(strict_types=1);

namespace App\Filament\Resources\Roles;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Pages\ViewRole;
use BezhanSalleh\FilamentShield\Support\Utils;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents;
use BezhanSalleh\PluginEssentials\Concerns\Resource as Essentials;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;
use Override;

use BezhanSalleh\FilamentShield\Facades\FilamentShield;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Component;
use Illuminate\Support\HtmlString;

class RoleResource extends Resource
{
    use Essentials\BelongsToParent;
    use Essentials\BelongsToTenant;
    use Essentials\HasGlobalSearch;
    use Essentials\HasLabels;
    use Essentials\HasNavigation;
    use HasShieldFormComponents;

    public static function getShieldFormComponents(): Component
    {
        return Section::make('Hak Akses Berdasarkan Grup')
            ->description('Pilih hak akses yang ingin diberikan kepada peran ini, dikelompokkan berdasarkan menu utama.')
            ->schema([
                Tabs::make('Permissions')
                    ->contained(false)
                    ->tabs([
                        static::getCombinedPermissionsTab(),
                        static::getTabFormComponentForWidget(),
                        static::getTabFormComponentForCustomPermissions(),
                    ]),
            ])
            ->columnSpan('full');
    }

    public static function getCombinedPermissionsTab(): Tab
    {
        $resources = FilamentShield::getResources();
        $pages = FilamentShield::getPages();
        
        $groupedData = [];

        // Group Resources
        foreach ($resources as $entity) {
            $group = 'Lainnya';
            if (method_exists($entity['resourceFqcn'], 'getNavigationGroup')) {
                $group = $entity['resourceFqcn']::getNavigationGroup() ?? 'Lainnya';
            }
            $groupedData[$group]['resources'][] = $entity;
        }

        // Group Pages
        foreach ($pages as $page) {
            $group = 'Lainnya';
            if (method_exists($page['pageFqcn'], 'getNavigationGroup')) {
                $group = $page['pageFqcn']::getNavigationGroup() ?? 'Lainnya';
            }
            $groupedData[$group]['pages'][] = $page;
        }

        // Priority Groups
        $priorityGroups = ['Sistem', 'Master Data', 'Manajemen Web'];
        uksort($groupedData, function ($a, $b) use ($priorityGroups) {
            $posA = array_search($a, $priorityGroups);
            $posB = array_search($b, $priorityGroups);
            if ($posA === false && $posB === false) return strcmp($a, $b);
            if ($posA === false) return 1;
            if ($posB === false) return -1;
            return $posA - $posB;
        });

        $groupSections = [];
        foreach ($groupedData as $groupName => $data) {
            $items = [];

            // Add Resources to the group
            if (isset($data['resources'])) {
                foreach ($data['resources'] as $entity) {
                    $label = strval(static::shield()->hasLocalizedPermissionLabels()
                        ? FilamentShield::getLocalizedResourceLabel($entity['resourceFqcn'])
                        : $entity['model']);

                    // Mapping Label Sistem
                    if ($groupName === 'Sistem') {
                        if (str_contains($entity['resourceFqcn'], 'SpmbRegistrantResource')) $label = 'Pendaftaran SPMB';
                        if (str_contains($entity['resourceFqcn'], 'UserResource')) $label = 'Manajemen Pengguna';
                        if (str_contains($entity['resourceFqcn'], 'ActivityLogResource')) $label = 'Log Aktivitas';
                        if (str_contains($entity['resourceFqcn'], 'SpmbSettingResource')) $label = 'Tahun Ajaran SPMB';
                    }
                    // Mapping Label Master Data
                    if ($groupName === 'Master Data') {
                        if (str_contains($entity['resourceFqcn'], 'DataSiswaResource')) $label = 'Data Siswa';
                        if (str_contains($entity['resourceFqcn'], 'GuruResource')) $label = 'Data Guru';
                    }

                    $items[] = Section::make($label)
                        ->compact()
                        ->schema([
                            static::getCheckboxListFormComponent(
                                name: $entity['resourceFqcn'],
                                options: static::getResourcePermissionOptions($entity),
                                searchable: false,
                                columns: [
                                    'default' => 1,
                                    'sm' => 2,
                                    'md' => 3,
                                    'lg' => 4,
                                ],
                            ),
                        ])
                        ->columnSpan(1)
                        ->collapsible();
                }
            }

            // Add Pages to the group
            if (isset($data['pages'])) {
                $pageOptions = [];
                foreach ($data['pages'] as $page) {
                    foreach ($page['permissions'] as $key => $pageLabel) {
                        // Mapping Label Page
                        if ($groupName === 'Master Data') {
                            if (str_contains($page['pageFqcn'], 'DataKelas')) $pageLabel = 'Akses Data Kelas';
                            if (str_contains($page['pageFqcn'], 'MataPelajaran')) $pageLabel = 'Akses Mata Pelajaran';
                        }
                        if ($groupName === 'Sistem' && str_contains($page['pageFqcn'], 'TahunAjaran')) {
                            $pageLabel = 'Akses Tahun Ajaran SPMB';
                        }
                        $pageOptions[$key] = $pageLabel;
                    }
                }

                if (!empty($pageOptions)) {
                    $items[] = Section::make('Akses Halaman')
                        ->description('Hak akses untuk membuka halaman menu di grup ' . $groupName)
                        ->compact()
                        ->schema([
                            static::getCheckboxListFormComponent(
                                name: 'pages_' . Str::snake($groupName),
                                options: $pageOptions,
                                columns: [
                                    'default' => 1,
                                    'sm' => 2,
                                ],
                            ),
                        ])
                        ->columnSpan(1)
                        ->collapsible();
                }
            }

            $groupSections[] = Section::make($groupName)
                ->description("Seluruh hak akses untuk menu di grup {$groupName}")
                ->schema([
                    Grid::make()
                        ->schema($items)
                        ->columns(1),
                ])
                ->collapsible()
                ->compact()
                ->extraAttributes(['class' => 'mb-6']);
        }

        return Tab::make('combined_permissions')
            ->label('Hak Akses Menu')
            ->schema($groupSections);
    }

    public static function getCustomResourceTab(): Component
    {
        // This is now handled by getCombinedPermissionsTab
        return Tab::make('old_resources')->visible(false);
    }

    public static function getTabFormComponentForPage(): Component
    {
        // This is now handled by getCombinedPermissionsTab
        return Tab::make('old_pages')->visible(false);
    }

    protected static ?string $recordTitleAttribute = 'name';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('filament-shield::filament-shield.field.name'))
                                    ->unique(
                                        ignoreRecord: true, /** @phpstan-ignore-next-line */
                                        modifyRuleUsing: fn (Unique $rule): Unique => Utils::isTenancyEnabled() ? $rule->where(Utils::getTenantModelForeignKey(), Filament::getTenant()?->id) : $rule
                                    )
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('guard_name')
                                    ->label(__('filament-shield::filament-shield.field.guard_name'))
                                    ->default(Utils::getFilamentAuthGuard())
                                    ->nullable()
                                    ->maxLength(255),

                                Select::make(config('permission.column_names.team_foreign_key'))
                                    ->label(__('filament-shield::filament-shield.field.team'))
                                    ->placeholder(__('filament-shield::filament-shield.field.team.placeholder'))
                                    /** @phpstan-ignore-next-line */
                                    ->default(Filament::getTenant()?->id)
                                    ->options(fn (): array => in_array(Utils::getTenantModel(), [null, '', '0'], true) ? [] : Utils::getTenantModel()::pluck('name', 'id')->toArray())
                                    ->visible(fn (): bool => static::shield()->isCentralApp() && Utils::isTenancyEnabled())
                                    ->dehydrated(fn (): bool => static::shield()->isCentralApp() && Utils::isTenancyEnabled()),
                                static::getSelectAllFormComponent(),

                            ])
                            ->columns([
                                'sm' => 2,
                                'lg' => 3,
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                static::getShieldFormComponents(),
            ]);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->weight(FontWeight::Medium)
                    ->label(__('filament-shield::filament-shield.column.name'))
                    ->formatStateUsing(fn (string $state): string => Str::headline($state))
                    ->searchable(),
                TextColumn::make('guard_name')
                    ->badge()
                    ->color('warning')
                    ->label(__('filament-shield::filament-shield.column.guard_name')),
                TextColumn::make('team.name')
                    ->default('Global')
                    ->badge()
                    ->color(fn (mixed $state): string => str($state)->contains('Global') ? 'gray' : 'primary')
                    ->label(__('filament-shield::filament-shield.column.team'))
                    ->searchable()
                    ->visible(fn (): bool => static::shield()->isCentralApp() && Utils::isTenancyEnabled()),
                TextColumn::make('permissions_count')
                    ->badge()
                    ->label(__('filament-shield::filament-shield.column.permissions'))
                    ->counts('permissions')
                    ->color('primary'),
                TextColumn::make('updated_at')
                    ->label(__('filament-shield::filament-shield.column.updated_at'))
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    #[Override]
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'view' => ViewRole::route('/{record}'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }

    #[Override]
    public static function getModel(): string
    {
        return Utils::getRoleModel();
    }

    public static function getSlug(?Panel $panel = null): string
    {
        return Utils::getResourceSlug();
    }

    public static function getCluster(): ?string
    {
        return Utils::getResourceCluster();
    }

    public static function getEssentialsPlugin(): ?FilamentShieldPlugin
    {
        return FilamentShieldPlugin::get();
    }
}
