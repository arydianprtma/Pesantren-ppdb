<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbPendaftaran extends Model
{
    protected $table = 'ppdb_pendaftaran';
    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($pendaftaran) {
            \App\Events\PpdbPendaftaranCreated::dispatch($pendaftaran);
        });

        static::updated(function ($pendaftaran) {
            \App\Events\PpdbPendaftaranUpdated::dispatch($pendaftaran);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa()
    {
        return $this->hasOne(PpdbSiswa::class, 'pendaftaran_id');
    }

    public function orangTua()
    {
        return $this->hasMany(PpdbOrangTua::class, 'pendaftaran_id');
    }

    public function ayah()
    {
        return $this->hasOne(PpdbOrangTua::class, 'pendaftaran_id')->where('jenis', 'ayah');
    }

    public function ibu()
    {
        return $this->hasOne(PpdbOrangTua::class, 'pendaftaran_id')->where('jenis', 'ibu');
    }

    public function wali()
    {
        return $this->hasOne(PpdbWali::class, 'pendaftaran_id');
    }

    public function periodik()
    {
        return $this->hasOne(PpdbPeriodik::class, 'pendaftaran_id');
    }

    public function prestasi()
    {
        return $this->hasMany(PpdbPrestasi::class, 'pendaftaran_id');
    }

    public function beasiswa()
    {
        return $this->hasMany(PpdbBeasiswa::class, 'pendaftaran_id');
    }

    public function berkas()
    {
        return $this->hasOne(PpdbBerkas::class, 'pendaftaran_id');
    }
}
