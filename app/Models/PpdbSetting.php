<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbSetting extends Model
{
    protected $table = 'ppdb_settings';

    protected $fillable = [
        'tahun_ajaran',
        'tgl_buka',
        'tgl_tutup',
        'is_active',
        'pesan_tutup',
        'kartu_header_1',
        'kartu_header_2',
        'kartu_alamat',
        'kartu_logo',
    ];

    protected $casts = [
        'tgl_buka' => 'datetime',
        'tgl_tutup' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->is_active) {
                $query = static::query();
                if ($model->exists) {
                    $query->where('id', '!=', $model->id);
                }
                $query->update(['is_active' => false]);
            }
        });
    }

    /**
     * Cek apakah pendaftaran sedang dibuka berdasarkan waktu saat ini
     */
    public static function isOpen(): bool
    {
        $setting = self::where('is_active', true)->latest()->first();
        
        if (!$setting) return false;

        $now = now();
        $tglBuka = $setting->tgl_buka->startOfDay();
        $tglTutup = $setting->tgl_tutup->endOfDay();

        return $now->between($tglBuka, $tglTutup);
    }
}
