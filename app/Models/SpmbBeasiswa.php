<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbBeasiswa extends Model
{
    protected $table = 'ppdb_beasiswa';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(SpmbPendaftaran::class, 'pendaftaran_id');
    }
}
