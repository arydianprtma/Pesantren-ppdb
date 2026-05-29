<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbPendaftaran extends Model
{
    protected $table = 'ppdb_pendaftaran';
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($pendaftaran) {
            \App\Events\SpmbPendaftaranCreated::dispatch($pendaftaran);
        });

        static::updated(function ($pendaftaran) {
            \App\Events\SpmbPendaftaranUpdated::dispatch($pendaftaran);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa()
    {
        return $this->hasOne(SpmbSiswa::class, 'pendaftaran_id');
    }

    public function orangTua()
    {
        return $this->hasMany(SpmbOrangTua::class, 'pendaftaran_id');
    }

    public function ayah()
    {
        return $this->hasOne(SpmbOrangTua::class, 'pendaftaran_id')->where('jenis', 'ayah');
    }

    public function ibu()
    {
        return $this->hasOne(SpmbOrangTua::class, 'pendaftaran_id')->where('jenis', 'ibu');
    }

    public function wali()
    {
        return $this->hasOne(SpmbWali::class, 'pendaftaran_id');
    }

    public function periodik()
    {
        return $this->hasOne(SpmbPeriodik::class, 'pendaftaran_id');
    }

    public function prestasi()
    {
        return $this->hasMany(SpmbPrestasi::class, 'pendaftaran_id');
    }

    public function beasiswa()
    {
        return $this->hasMany(SpmbBeasiswa::class, 'pendaftaran_id');
    }

    public function berkas()
    {
        return $this->hasOne(SpmbBerkas::class, 'pendaftaran_id');
    }
}
