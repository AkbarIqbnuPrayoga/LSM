<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPelatihanIdToVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
{
    Schema::table('visitors', function (Blueprint $table) {
        $table->unsignedBigInteger('pelatihan_id')->after('user_id')->nullable();

        // pastikan tabel pelatihans SUDAH ADA
        $table->foreign('pelatihan_id')->references('id')->on('pelatihan')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('visitors', function (Blueprint $table) {
        $table->dropForeign(['pelatihan_id']);
        $table->dropColumn('pelatihan_id');
    });
}
}
