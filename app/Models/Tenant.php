<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara mass assignment
    protected $fillable = [
        'tenant_name',  // Nama pengontrak
        'spouse_name',  // Nama pasangan (opsional)
        'start_date',   // Tanggal mulai kontrak
        'end_date',     // Tanggal akhir kontrak
        'house_id',     // ID rumah yang ditempati
        'photo',
    ];

    // Relasi dengan model House (BelongsTo)
    public function tenants()
    {
        return $this->belongsTo(House::class);
    }
    
    public function house()
{
    return $this->belongsTo(House::class, 'house_id');
}
    
     // File: app/Models/House.php
    public function getStatusLocalizedAttribute()
    {
        return match ($this->status){
            'vacant' => 'Kosong',
            'occupied' => 'Ditempati',
            'rented' => 'Dikontrakkan',
            default => 'Tidak Diketahui',
        };
    }
    
    
}



    
    
    
   
    