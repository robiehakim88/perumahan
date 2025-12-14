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
    Schema::create('residents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('house_id')->constrained()->onDelete('cascade'); // Relasi ke tabel houses
        $table->string('name'); // Nama penghuni
        $table->string('relationship'); // Hubungan keluarga (contoh: suami, istri, anak, dll.)
        $table->string('place_of_birth'); // Tempat lahir
        $table->date('date_of_birth'); // Tanggal lahir
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
    }
};
