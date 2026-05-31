<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SekolahProfil extends Model
{
    protected $table = 'sekolah_profil';
    protected $guarded = [];

    protected static function booted()
    {
        static::saved(fn () => Cache::forget('smp_profil'));
        static::deleted(fn () => Cache::forget('smp_profil'));
    }
}
