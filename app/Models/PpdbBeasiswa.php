<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbBeasiswa extends Model
{
    protected $table = 'ppdb_beasiswa';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(PpdbPendaftaran::class, 'pendaftaran_id');
    }
}
