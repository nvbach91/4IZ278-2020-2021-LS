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
            $table->string('sector')->nullable();
            $table->integer('seat')->unsigned()->nullable();
            $table->foreignId('user_id')->constrained('user')->references('user_id')->cascadeOnDelete();
            $table->foreignId('event_id')->constrained('event')->references('event_id')->cascadeOnDelete();
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
