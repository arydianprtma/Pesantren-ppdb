<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbRegistrant extends Model
{
    protected $table = 'pendaftar_ppdb';

    protected $guarded = [];

    protected $casts = [
        'status' => 'string',
        'jenis_kelamin' => 'string',
    ];
}
