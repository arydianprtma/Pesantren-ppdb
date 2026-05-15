<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbPrestasi extends Model
{
    protected $table = 'spmb_prestasi';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(SpmbPendaftaran::class, 'pendaftaran_id');
    }
}
