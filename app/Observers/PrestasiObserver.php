<?php

namespace App\Observers;

use App\Models\Prestasi;

class PrestasiObserver
{
    private function clearCache()
    {
        \Illuminate\Support\Facades\Cache::forget('home_prestasi');
        \Illuminate\Support\Facades\Cache::forget('prestasi_tahun_list');

        // Hapus semua cache yang diawali dengan 'prestasi_list_'
        // Catatan: Ini metode brute-force jika menggunakan driver file/database.
        // Untuk production dengan Redis, bisa menggunakan tags.
        // Simulasi penghapusan wildcard untuk driver file/db sederhananya kita clear semua
        // atau kita biarkan cache expired sendiri (60 menit).
        // Tapi untuk best practice sederhana di sini, kita hapus cache utama.
    }

    /**
     * Handle the Prestasi "created" event.
     */
    public function created(Prestasi $prestasi): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Prestasi "updated" event.
     */
    public function updated(Prestasi $prestasi): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Prestasi "deleted" event.
     */
    public function deleted(Prestasi $prestasi): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Prestasi "restored" event.
     */
    public function restored(Prestasi $prestasi): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Prestasi "force deleted" event.
     */
    public function forceDeleted(Prestasi $prestasi): void
    {
        $this->clearCache();
    }
}
