<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\House;
use App\Models\Tenant;
use App\Models\WargaAktif;

class SyncWargaAktif extends Command
{
    protected $signature = 'sync:warga-aktif';
    protected $description = 'Sinkronisasi data warga aktif dari tabel houses dan tenants';

    public function handle()
{
    // Bersihkan data lama
    WargaAktif::truncate();

    // Ambil semua data rumah beserta pengontrak aktif
    $houses = House::with(['tenants' => function ($query) {
        $query->whereDate('end_date', '>=', now()); // Hanya ambil tenant yang masih aktif
    }])->get();

    foreach ($houses as $house) {
        // Jika rumah memiliki pengontrak aktif
        if ($house->tenants->isNotEmpty()) {
            foreach ($house->tenants as $tenant) {
                WargaAktif::create([
                    'nama_penghuni_rumah' => $tenant->tenant_name,
                    'nomor_rumah' => $house->house_number,
                    'status_rumah' => $house->status,
                    'is_active' => true, // Pengontrak aktif
                ]);
            }
        }

        // Jika rumah tidak kosong, tambahkan pemilik rumah sebagai entri
        if ($house->status !== 'vacant') {
            WargaAktif::create([
                'nama_penghuni_rumah' => $house->owner_name,
                'nomor_rumah' => $house->house_number,
                'status_rumah' => $house->status,
                'is_active' => true, // Pemilik aktif
            ]);
        }
    }

    $this->info('Data warga aktif berhasil disinkronisasi.');
}
}