<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gps');
            $table->string('img',1023);
            $table->foreignId('galaxy_id')->references('id')->on('galaxies');
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
        Schema::dropIfExists('space_stations');
    }
}
