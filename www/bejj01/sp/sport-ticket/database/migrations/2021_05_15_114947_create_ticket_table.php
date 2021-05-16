<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->string('sector')->nullable();
            $table->integer('seat')->unsigned()->nullable();
            $table->foreign('user_id')->references('user_id')->on('user')->cascadeOnDelete();
            $table->foreign('event_id')->references('event_id')->on('event')->cascadeOnDelete();
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
        Schema::dropIfExists('ticket');
    }
}
