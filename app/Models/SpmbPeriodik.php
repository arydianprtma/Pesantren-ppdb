<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbPeriodik extends Model
{
    protected $table = 'spmb_periodik';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(SpmbPendaftaran::class, 'pendaftaran_id');
    }
}
