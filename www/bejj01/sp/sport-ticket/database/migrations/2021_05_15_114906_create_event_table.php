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
            $table->foreignId('sport_id')->constrained('sport')->references('sport_id')->cascadeOnDelete();
            $table->foreignId('place_id')->nullable()->constrained('place')->references('place_id')->nullOnDelete();
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
