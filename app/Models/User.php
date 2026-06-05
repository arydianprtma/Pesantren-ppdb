<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Ninja Fix: Mencegah konflik kolom 'permissions' dengan Spatie
     */
    protected static function booted()
    {
        static::retrieved(function ($model) {
            if (array_key_exists('permissions', $model->attributes)) {
                $model->attributes['custom_permissions'] = $model->attributes['permissions'];
                unset($model->attributes['permissions']);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'password',
        'avatar',
        'role',
        'custom_permissions',
        'is_active',
        'otp_code',
        'otp_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'custom_permissions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the user's avatar for Filament
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if (!$this->avatar) {
            return null;
        }

        if (filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }
        
        $avatarPath = ltrim($this->avatar, '/');
        
        if (Storage::disk('public')->exists($avatarPath)) {
            return asset('storage/' . $avatarPath);
        }
        
        if (config('filesystems.disks.ppdb') && Storage::disk('ppdb')->exists($avatarPath)) {
            return asset('ppdb-storage/' . $avatarPath);
        }

        if (config('filesystems.disks.ppdb_public') && Storage::disk('ppdb_public')->exists($avatarPath)) {
            return asset('ppdb-public-storage/' . $avatarPath);
        }
        
        return asset('storage/' . $avatarPath);
    }

    /**
     * Relationship to Berita (news articles authored by this user)
     */
    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class);
    }

    /**
     * Get the custom permissions attribute.
     * Mencegah konflik dengan sistem Spatie Permission.
     */
    public function getCustomPermissionsAttribute()
    {
        return $this->attributes['custom_permissions'] ?? $this->attributes['permissions'] ?? null;
    }

    /**
     * Check if user can access Filament panel
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return ($this->is_active ?? true)
            && ($this->hasAnyRole(['super_admin', 'admin', 'panel_user']) || $this->hasPermission('view_admin_panel'));
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    /**
     * Check if user is admin (super_admin or admin)
     */
    public function isAdmin(): bool
    {
        return $this->hasAnyRole(['super_admin', 'admin']);
    }

    /**
     * Check if user is editor only (based on permissions usually)
     */
    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    /**
     * Check if user can manage web content
     */
    public function canManageContent(): bool
    {
        return $this->isAdmin() || $this->hasRole('editor');
    }

    /**
     * Check if user has permission
     */
    public function hasPermission(string $permission): bool
    {
        // Super Admin selalu memiliki semua permission
        if ($this->hasRole('super_admin')) {
            return true;
        }

        // Gunakan can() tapi bungkus dengan try-catch karena Spatie bisa throw exception
        // jika permission name tidak terdaftar di database.
        try {
            return $this->can($permission);
        } catch (\Spatie\Permission\Exceptions\PermissionDoesNotExist $e) {
            return false;
        }
    }
}
