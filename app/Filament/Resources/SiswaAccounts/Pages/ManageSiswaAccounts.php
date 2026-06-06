<?php

namespace App\Filament\Resources\SiswaAccounts\Pages;

use App\Filament\Resources\SiswaAccounts\SiswaAccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSiswaAccounts extends ManageRecords
{
    protected static string $resource = SiswaAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->modalWidth('2xl')
                ->mutateFormDataUsing(function (array $data): array {
                    $data['role'] = 'siswa';
                    return $data;
                })
                ->after(function (\App\Models\User $record) {
                    // Pastikan role siswa Spatie Permission terbuat
                    \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);
                    
                    // Assign role Spatie Permission ke user
                    $record->assignRole('siswa');
                }),
        ];
    }
}
