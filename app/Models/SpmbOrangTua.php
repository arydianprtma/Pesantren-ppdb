<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbOrangTua extends Model
{
    protected $table = 'ppdb_orang_tua';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(SpmbPendaftaran::class, 'pendaftaran_id');
    }
}
