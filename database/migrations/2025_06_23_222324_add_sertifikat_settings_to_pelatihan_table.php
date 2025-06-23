<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSertifikatSettingsToPelatihanTable extends Migration
{
    public function up()
    {
        Schema::table('pelatihan', function (Blueprint $table) {
            $table->integer('pos_x')->nullable();
            $table->integer('pos_y')->nullable();
            $table->integer('font_size')->nullable();
            $table->string('font_color')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pelatihan', function (Blueprint $table) {
            $table->dropColumn(['pos_x', 'pos_y', 'font_size', 'font_color']);
        });
    }
}
