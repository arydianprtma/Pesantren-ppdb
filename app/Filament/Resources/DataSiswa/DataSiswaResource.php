<?php

namespace App\Filament\Resources\DataSiswa;

use App\Filament\Resources\Concerns\AdminOnlyAccess;
use App\Filament\Resources\DataSiswa\Pages\ListDataSiswa;
use App\Filament\Resources\DataSiswa\Pages\ViewDataSiswa;
use App\Models\PpdbSiswa;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;

class DataSiswaResource extends Resource
{
    use AdminOnlyAccess;

    protected static ?string $model = PpdbSiswa::class;
    protected static ?string $slug = 'data-siswa';

    public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-users'; }
    public static function getNavigationLabel(): string { return 'Data Siswa'; }
    public static function getNavigationGroup(): string|\UnitEnum|null { return 'Master Data'; }
    public static function getNavigationSort(): ?int { return 5; }
    public static function getModelLabel(): string { return 'Siswa'; }
    public static function getPluralModelLabel(): string { return 'Data Siswa'; }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['pendaftaran.user'])
            ->whereHas('pendaftaran', function (Builder $query) {
                // Hanya tampilkan siswa yang SUDAH DITERIMA
                // (menyelesaikan seluruh proses seleksi & administrasi)
                $query->whereIn('status', [
                    'diterima_ula',
                    'diterima_idadiyah',
                    'diterima_wustho',
                    'diterima_ulya',
                ]);
            });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('pendaftaran.user.avatar')
                    ->label('Foto')
                    ->circular()
                    ->disk('ppdb')
                    ->defaultImageUrl(fn($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->nama_lengkap) . '&color=10b981&background=d1fae5'),

                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('jenis_kelamin')
                    ->label('L/P')
                    ->badge()
                    ->color(fn($state) => $state === 'L' ? 'info' : 'pink')
                    ->formatStateUsing(fn($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan'),

                TextColumn::make('pendaftaran.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => match($state) {
                        'diterima_ula', 'diterima_idadiyah', 'diterima_wustho', 'diterima_ulya' => 'success',
                        'ditolak'         => 'danger',
                        'wawancara'       => 'warning',
                        'jadwal_tes', 'tes_berlangsung' => 'info',
                        default           => 'gray',
                    })
                    ->formatStateUsing(fn($state) => match($state) {
                        'pending'           => 'Menunggu Verifikasi',
                        'jadwal_tes'        => 'Jadwal Tes',
                        'tes_berlangsung'   => 'Tes Berlangsung',
                        'wawancara'         => 'Wawancara',
                        'diterima_ula'      => 'Diterima - Ula',
                        'diterima_idadiyah'  => 'Diterima - Idadiyah',
                        'diterima_wustho'   => 'Diterima - Wustho',
                        'diterima_ulya'     => 'Diterima - Ulya',
                        'ditolak'           => 'Tidak Diterima',
                        default             => ucfirst($state),
                    }),

                TextColumn::make('pendaftaran.tingkat')
                    ->label('Tingkat')
                    ->formatStateUsing(fn($state) => strtoupper($state))
                    ->badge()
                    ->color('gray'),

                TextColumn::make('nis')
                    ->label('NIS (Nomor Induk Siswa)')
                    ->searchable()
                    ->copyable()
                    ->placeholder('-'),

                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->copyable()
                    ->placeholder('-'),

                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable()
                    ->copyable()
                    ->placeholder('-'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Jenjang Diterima')
                    ->options([
                        'diterima_ula'      => 'Ula',
                        'diterima_idadiyah' => 'Idadiyah',
                        'diterima_wustho'   => 'Wustho',
                        'diterima_ulya'     => 'Ulya',
                    ])
                    ->query(fn (Builder $query, array $data) => 
                        $query->when($data['value'], fn ($q, $value) => 
                            $q->whereHas('pendaftaran', fn ($pq) => $pq->where('status', $value))
                        )
                    ),

                SelectFilter::make('tingkat')
                    ->label('Tingkat Sekolah')
                    ->options([
                        'smp' => 'SMP',
                        'sma' => 'SMA',
                    ])
                    ->query(fn (Builder $query, array $data) => 
                        $query->when($data['value'], fn ($q, $value) => 
                            $q->whereHas('pendaftaran', fn ($pq) => $pq->where('tingkat', $value))
                        )
                    ),

                SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options(['L' => 'Laki-laki', 'P' => 'Perempuan']),
            ])
            ->recordUrl(fn($record) => static::getUrl('view', ['record' => $record]));
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDataSiswa::route('/'),
            'view'  => ViewDataSiswa::route('/{record}'),
        ];
    }
}
