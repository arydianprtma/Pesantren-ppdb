<?php

namespace App\Filament\Resources\Concerns;

use Illuminate\Support\Facades\Auth;

/**
 * Trait untuk Resource yang dapat diakses oleh semua role admin panel
 * (Super Admin, Admin, dan Editor)
 *
 * Gunakan pada: Berita, Prestasi, Fasilitas, Sejarah, VisiMisi, Ekstrakurikuler, Kontak
 */
trait ContentManagerAccess
{
    public static function canAccess(): bool
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        if (!$user?->canManageContent()) {
            return false;
        }

        // Jika resource mendefinisikan permission khusus, periksa hak aksesnya
        if (property_exists(static::class, 'permission') && static::$permission) {
            return $user->hasPermission(static::$permission);
        }

        return true;
    }
}
