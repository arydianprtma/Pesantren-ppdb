<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbOrangTua extends Model
{
    protected $table = 'ppdb_orang_tua';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(PpdbPendaftaran::class, 'pendaftaran_id');
    }
}
