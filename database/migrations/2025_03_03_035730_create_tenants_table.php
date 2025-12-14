<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_name'); // Nama pengontrak
            $table->string('spouse_name')->nullable(); // Nama pasangan (opsional)
            $table->date('start_date'); // Tanggal mulai kontrak
            $table->date('end_date'); // Tanggal akhir kontrak
            $table->foreignId('house_id')->constrained()->onDelete('cascade'); // Relasi ke tabel houses
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};

