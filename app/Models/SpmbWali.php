<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbWali extends Model
{
    protected $table = 'ppdb_wali';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(SpmbPendaftaran::class, 'pendaftaran_id');
    }
}
