<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageHelper
{
    public static function addWatermark($filePath, $watermarkText = 'Dokumentasi RT 003 RW 004')
    {
        // Baca file dari storage
        $imagePath = storage_path('app/public/' . $filePath);
        if (!file_exists($imagePath)) {
            return null; // Jika file tidak ada, kembalikan null
        }

        // Load gambar menggunakan Intervention Image
        $img = Image::make($imagePath);

        // Tambahkan watermark
        $img->text($watermarkText, $img->width() - 20, $img->height() - 20, function ($font) {
            $font->file(5); // Gunakan font internal GD nomor 5
            $font->size(20); // Ukuran font
            $font->color('#ffffff'); // Warna font (putih)
            $font->align('right'); // Align teks
            $font->valign('bottom'); // Vertical align
        });

        // Simpan gambar dengan watermark ke folder sementara
        $tempPath = 'temp/' . basename($filePath);
        $img->save(storage_path('app/public/' . $tempPath));

        return asset('storage/' . $tempPath); // Kembalikan URL gambar dengan watermark
    }
}