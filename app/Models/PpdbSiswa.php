<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbSiswa extends Model
{
    protected $table = 'ppdb_siswa';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(PpdbPendaftaran::class, 'pendaftaran_id');
    }
}
