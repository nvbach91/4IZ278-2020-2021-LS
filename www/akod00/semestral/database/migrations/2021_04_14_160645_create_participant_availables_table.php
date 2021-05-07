<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantAvailablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_availables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("participant_id")->unsigned();
            $table->foreign("participant_id")->references('id')->on("users")->onDelete("cascade");
            $table->bigInteger("date_id")->unsigned();
            $table->foreign("date_id")->references("id")->on("dates")->onDelete("cascade");
            $table->integer("state");
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
        Schema::dropIfExists('participant_availables');
    }
}
