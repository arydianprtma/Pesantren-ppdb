<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbPeriodik extends Model
{
    protected $table = 'ppdb_periodik';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(PpdbPendaftaran::class, 'pendaftaran_id');
    }
}
