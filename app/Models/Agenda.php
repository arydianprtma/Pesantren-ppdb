<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class Agenda extends Model
{
    protected $table = 'agenda';
    
    protected $guarded = [];

    protected $casts = [
        'tgl_mulai' => 'date:Y-m-d',
        'tgl_selesai' => 'date:Y-m-d',
        'is_active' => 'boolean',
    ];

    /**
     * Clear caches on model events
     */
    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('schedules_list');
            Cache::forget('home_agenda');
        });

        static::deleted(function () {
            Cache::forget('schedules_list');
            Cache::forget('home_agenda');
        });
    }

    /**
     * Scope for active agendas
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for upcoming agendas (starting from today onwards or ending today/future)
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->where('tgl_mulai', '>=', now()->startOfDay())
              ->orWhere(function ($sub) {
                  $sub->whereNotNull('tgl_selesai')
                      ->where('tgl_selesai', '>=', now()->startOfDay());
              });
        });
    }
}
