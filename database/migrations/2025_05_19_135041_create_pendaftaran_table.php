<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('pendaftaran', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('pelatihan_id')->constrained('pelatihan')->onDelete('cascade');
        $table->string('bukti_pembayaran')->nullable();// atau after kolom terakhir sesuai kebutuhan
        $table->enum('status_validasi', ['pending', 'valid', 'tidak valid'])->default('pending');
        $table->string('sertifikat')->nullable();
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
        Schema::dropIfExists('pendaftaran');
    }
}
