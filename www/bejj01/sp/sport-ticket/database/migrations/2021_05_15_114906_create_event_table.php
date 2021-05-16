<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('event_name');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('img');
            $table->decimal('price', 8, 2, true);
            $table->string('competition')->nullable();
            $table->integer('capacity')->unsigned()->default(0);
            $table->text('description')->nullable();
            $table->integer('sport_id')->unsigned();
            $table->integer('place_id')->unsigned()->nullable();
            $table->foreign('sport_id')->references('sport')->on('sport_id')->onDelete('cascade');
            $table->foreign('place_id')->references('place')->on('place_id')->onDelete('set null');
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
        Schema::dropIfExists('event');
    }
}
