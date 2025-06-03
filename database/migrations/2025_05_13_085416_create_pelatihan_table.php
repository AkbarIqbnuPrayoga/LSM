<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihanTable extends Migration
{
    public function up()
    {
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gambar');
            $table->string('tag'); // Simpan sebagai 'offline', 'online', atau 'hybrid'
            $table->date('tanggal')->nullable();
            $table->longText('konten');
            $table->integer('kuota')->default(0);
            $table->string('rekening');
            $table->string('atas_nama')->nullable();
            $table->string('bank')->nullable();
            $table->string('lokasi')->nullable(); // untuk tag offline/hybrid
            $table->string('zoom_link')->nullable(); // untuk tag online/hybrid
            $table->string('status')->default('public');
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
        Schema::dropIfExists('pelatihan');
    }
}
