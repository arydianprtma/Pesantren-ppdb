<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = [];

    public function pendaftarans()
    {
        return $this->hasMany(PpdbPendaftaran::class, 'kelas_id');
    }
}
