<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaAktifTable extends Migration
{
    public function up()
    {
        Schema::create('warga_aktif', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penghuni_rumah');
            $table->string('nomor_rumah');
            $table->enum('status_rumah', ['vacant', 'occupied', 'rented']);
            $table->boolean('is_active')->default(true); // Default aktif
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warga_aktif');
    }
}