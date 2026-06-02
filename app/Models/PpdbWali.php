<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbWali extends Model
{
    protected $table = 'ppdb_wali';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(PpdbPendaftaran::class, 'pendaftaran_id');
    }
}
