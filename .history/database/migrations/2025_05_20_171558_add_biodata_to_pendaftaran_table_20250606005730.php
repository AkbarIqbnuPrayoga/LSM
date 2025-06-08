<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiodataToPendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::table('pendaftaran', function (Blueprint $table) {
        $table->string('nama_lengkap')->nullable();
        $table->string('email')->nullable();
        $table->string('no_telp')->nullable();
        $table->string('instansi')->nullable();
        $table->string('tipe_peserta')->nullable()->after('instansi');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            //
        });
    }
}
