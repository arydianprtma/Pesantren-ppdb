<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbRegistrant extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => 'string',
        'jenis_kelamin' => 'string',
    ];
}
