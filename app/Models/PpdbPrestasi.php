<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbPrestasi extends Model
{
    protected $table = 'ppdb_prestasi';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(PpdbPendaftaran::class, 'pendaftaran_id');
    }
}
