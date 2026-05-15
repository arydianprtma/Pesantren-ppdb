<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbBerkas extends Model
{
    protected $table = 'spmb_berkas';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(SpmbPendaftaran::class, 'pendaftaran_id');
    }
}
