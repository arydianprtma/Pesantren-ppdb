<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'tingkat',
        'tahun',
        'deskripsi',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];
}
