<?php

namespace App\Filament\Resources\Kelas\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\AssociateAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\BulkActionGroup;

class PendaftaransRelationManager extends RelationManager
{
    protected static string $relationship = 'pendaftarans';

    protected static ?string $title = 'Daftar Siswa';

    protected static ?string $modelLabel = 'Siswa';

    protected static ?string $pluralModelLabel = 'Siswa';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->inverseRelationship('kelas')
            ->recordTitle(fn ($record) => ($record->siswa?->nama_lengkap ?? $record->no_reg) . " (" . $record->no_reg . ")")
            ->columns([
                Tables\Columns\TextColumn::make('no_reg')
                    ->label('No. Registrasi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('siswa.nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('siswa.nisn')
                    ->label('NISN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diterima_ula', 'diterima_idadiyah', 'diterima_wustho', 'diterima_ulya' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AssociateAction::make()
                    ->label('Tambah Siswa ke Kelas')
                    ->multiple()
                    ->slideOver()
                    ->form(fn () => [
                        Forms\Components\CheckboxList::make('recordId')
                            ->label('Pilih Siswa')
                            ->required()
                            ->searchable()
                            ->bulkToggleable()
                            ->options(function () {
                                return \App\Models\PpdbPendaftaran::whereIn('status', ['diterima_ula', 'diterima_idadiyah', 'diterima_wustho', 'diterima_ulya'])
                                    ->whereNull('kelas_id')
                                    ->with('siswa')
                                    ->get()
                                    ->mapWithKeys(fn ($record) => [
                                        $record->id => ($record->siswa?->nama_lengkap ?? $record->no_reg) . " (" . $record->no_reg . ")"
                                    ]);
                            })
                            ->rules([
                                function ($livewire) {
                                    return function (string $attribute, $value, \Closure $fail) use ($livewire) {
                                        $kelas = $livewire->getOwnerRecord();
                                        $kapasitas = (int) ($kelas->kapasitas ?? 0);
                                        $currentCount = $kelas->pendaftarans()->count();
                                        $availableSlots = $kapasitas - $currentCount;

                                        $selectedCount = is_array($value) ? count($value) : 0;

                                        if ($selectedCount > $availableSlots) {
                                            $fail("Kapasitas kelas tidak mencukupi! Maksimal kapasitas: {$kapasitas}, Terisi: {$currentCount}, Tersedia: {$availableSlots} slot. Anda mencoba memasukkan {$selectedCount} siswa.");
                                        }
                                    };
                                }
                            ])
                            ->extraAlpineAttributes([
                                'x-init' => "\$nextTick(() => {
                                    let opts = \$el.querySelector('.fi-fo-checkbox-list-options');
                                    if (opts) {
                                        opts.style.maxHeight = 'calc(100vh - 300px)';
                                        opts.style.overflowY = 'auto';
                                        opts.style.overflowX = 'hidden';
                                    }
                                })",
                            ]),
                    ]),
            ])
            ->actions([
                DissociateAction::make()
                    ->label('Keluarkan dari Kelas'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make()
                        ->label('Keluarkan dari Kelas'),
                ]),
            ]);
    }
}
