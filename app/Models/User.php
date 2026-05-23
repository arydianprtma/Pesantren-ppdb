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

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
        'permissions',
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
            'permissions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the user's avatar for Filament
     */
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar
            ? Storage::url($this->avatar)
            : null;
    }

    /**
     * Relationship to Berita (news articles authored by this user)
     */
    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class);
    }

    /**
     * Check if user can access Filament panel
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return ($this->is_active ?? true)
            && in_array($this->role, ['super_admin', 'admin', 'editor'], true);
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is admin (super_admin or admin, NOT editor)
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    /**
     * Check if user is editor only
     */
    public function isEditor(): bool
    {
        return $this->role === 'editor';
    }

    /**
     * Check if user can manage web content (Berita, Prestasi, Fasilitas, Sejarah, VisiMisi, Ekstrakurikuler, Kontak)
     * Includes super_admin, admin, AND editor
     */
    public function canManageContent(): bool
    {
        return in_array($this->role, ['super_admin', 'admin', 'editor']);
    }

    /**
     * Check if user has permission
     */
    public function hasPermission(string $permission): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return in_array($permission, $this->permissions ?? []);
    }

    /**
     * Available permissions
     */
    public static function availablePermissions(): array
    {
        return [
            'manage_berita' => 'Kelola Berita',
            'manage_prestasi' => 'Kelola Prestasi',
            'manage_Spmb' => 'Kelola Spmb',
            'manage_contacts' => 'Kelola Pesan Kontak',
            'manage_settings' => 'Kelola Pengaturan',
            'view_reports' => 'Lihat Laporan',
        ];
    }
}
