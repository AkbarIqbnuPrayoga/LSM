<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTemplateSertifikatToPelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('pelatihan', function (Blueprint $table) {
        $table->string('template_sertifikat')->nullable();
    });
}

public function down()
{
    Schema::table('pelatihan', function (Blueprint $table) {
        $table->dropColumn('template_sertifikat');
    });
}

}
