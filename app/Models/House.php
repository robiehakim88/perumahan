<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara mass assignment
    protected $fillable = [
        'house_number', // Nomor rumah
        'owner_name',   // Nama pemilik rumah
        'spouse_name',  // Nama pasangan (opsional)
        'status',       // Status rumah (vacant, occupied, rented)
        'photo',        // Foto pemilik (opsional)
    ];

    // Relasi dengan model Tenant (One-to-Many)
    public function tenants()
    {
        return $this->hasMany(Tenant::class);
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
    
    // Relasi dengan model Resident (One-to-Many)
public function residents()
{
    return $this->hasMany(Resident::class);
}
    
    
    
    
}