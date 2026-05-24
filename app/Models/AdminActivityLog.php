<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminActivityLog extends Model
{
    protected $table = 'admin_activity_logs';
    protected $guarded = [];

    protected $casts = [
        'sebelum' => 'array',
        'sesudah' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Catat log aktivitas secara statis
     */
    public static function catat(
        string $modul,
        string $aksi,
        string $deskripsi,
        ?Model $model = null,
        array $sebelum = [],
        array $sesudah = []
    ): void {
        $user = auth()->user();

        static::create([
            'user_id'    => $user?->id,
            'modul'      => $modul,
            'aksi'       => $aksi,
            'model_type' => $model ? get_class($model) : null,
            'model_id'   => $model?->getKey(),
            'deskripsi'  => $deskripsi,
            'sebelum'    => !empty($sebelum) ? $sebelum : null,
            'sesudah'    => !empty($sesudah) ? $sesudah : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
