<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }

    protected static function booted()
    {
        static::saved(fn () => Cache::forget('fasilitas'));
        static::deleted(fn () => Cache::forget('fasilitas'));
    }
}
