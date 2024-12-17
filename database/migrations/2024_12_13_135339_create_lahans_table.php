<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLahansTable extends Migration
{
    public function up()
    {
        Schema::create('lahans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lahan');
            $table->text('deskripsi');
            $table->json('geojson_data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lahans');
    }
}
