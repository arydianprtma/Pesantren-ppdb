<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class VisiMisi extends Model
{
    protected $table = 'visi_misi';
    protected $guarded = [];

    protected static function booted()
    {
        static::saved(fn () => Cache::forget('home_visi_misi'));
        static::deleted(fn () => Cache::forget('home_visi_misi'));
    }
}
