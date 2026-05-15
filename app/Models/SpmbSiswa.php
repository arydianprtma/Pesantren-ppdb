<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbSiswa extends Model
{
    protected $table = 'spmb_siswa';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(SpmbPendaftaran::class, 'pendaftaran_id');
    }
}
