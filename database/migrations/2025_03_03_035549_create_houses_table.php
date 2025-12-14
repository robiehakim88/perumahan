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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('house_number')->unique(); // Nomor rumah (unik)
            $table->string('owner_name'); // Nama pemilik rumah
            $table->string('spouse_name')->nullable(); // Nama pasangan (opsional)
            $table->enum('status', ['vacant', 'occupied', 'rented'])->default('vacant'); // Status rumah
            $table->string('photo')->nullable(); // Foto pemilik (opsional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('houses');
    }
};

