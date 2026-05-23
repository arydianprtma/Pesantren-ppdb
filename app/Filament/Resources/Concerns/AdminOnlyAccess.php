<?php

namespace App\Filament\Resources\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Trait untuk Resource yang hanya dapat diakses oleh Super Admin dan Admin
 * (tidak termasuk Editor)
 *
 * Gunakan pada: SPMB, DataSiswa, Guru, Pesan Masuk, Pengaturan, SpmbSetting
 */
trait AdminOnlyAccess
{
    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (!$user?->isAdmin()) {
            return false;
        }

        // Jika resource mendefinisikan permission khusus, periksa hak aksesnya
        if (property_exists(static::class, 'permission') && static::$permission) {
            return $user->hasPermission(static::$permission);
        }

        return true;
    }
}
