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
    Schema::table('houses', function (Blueprint $table) {
        $table->string('family_card_photo')->nullable(); // Foto KK
        $table->json('family_members_photos')->nullable(); // Foto anggota keluarga
    });
}

public function down()
{
    Schema::table('houses', function (Blueprint $table) {
        $table->dropColumn(['family_card_photo', 'family_members_photos']);
    });
}
};
