<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WargaAktif extends Model
{
    protected $fillable = [
        'nama_penghuni_rumah',
        'nomor_rumah',
        'status_rumah',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}