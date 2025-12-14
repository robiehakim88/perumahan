<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data users sebelum menambahkan data baru (opsional)
        User::truncate();

        // Tambahkan data dummy untuk tabel users
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Password dienkripsi
            'role' => 'admin', // Role admin
        ]);

        User::create([
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'password' => bcrypt('password'), // Password dienkripsi
            'role' => 'user', // Role user biasa
        ]);
    }
}