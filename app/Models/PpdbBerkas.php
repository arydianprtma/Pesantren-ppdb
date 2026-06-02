<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbBerkas extends Model
{
    protected $table = 'ppdb_berkas';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->belongsTo(PpdbPendaftaran::class, 'pendaftaran_id');
    }
}
