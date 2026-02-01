<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'konten',
        'gambar',
        'kategori',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected $appends = ['is_new', 'author_name'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
            if (empty($berita->published_at) && $berita->is_published) {
                $berita->published_at = now();
            }
            // Auto set user_id from authenticated user
            if (empty($berita->user_id) && auth()->check()) {
                $berita->user_id = auth()->id();
            }
        });
    }

    /**
     * Relationship to User (Author)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if news is new (within 3 days)
     */
    public function getIsNewAttribute(): bool
    {
        if (!$this->published_at) {
            return false;
        }
        return $this->published_at->diffInDays(now()) <= 3;
    }

    /**
     * Get author name
     */
    public function getAuthorNameAttribute(): string
    {
        return $this->user?->name ?? 'Admin';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
