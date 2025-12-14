<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Resident extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara mass assignment
    protected $fillable = [
        'house_id',
        'name',
        'relationship',
        'place_of_birth',
        'date_of_birth',
        'gender',
    ];

    // Relasi ke House (BelongsTo)
    public function house()
    {
        return $this->belongsTo(House::class);
    }
    
    
    /**
     * Menghitung usia penghuni berdasarkan tanggal lahir.
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }
}