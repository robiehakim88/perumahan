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
    Schema::table('residents', function (Blueprint $table) {
        $table->string('gender')->nullable()->after('date_of_birth'); // Menambahkan kolom jenis kelamin
    });
}

public function down()
{
    Schema::table('residents', function (Blueprint $table) {
        $table->dropColumn('gender'); // Menghapus kolom jika rollback
    });
}
};
