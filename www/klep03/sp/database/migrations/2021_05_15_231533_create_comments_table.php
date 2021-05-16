<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_posted');
            // $table->unsignedBigInteger('song');
            $table->foreignId('song')->references('id')->on('songs');
            // $table->unsignedBigInteger('response_to');
            $table->foreignId('response_to')->references('id')->on('comments');
            $table->longText('content');
            // $table->unsignedBigInteger('author');
            $table->foreignId('author')->references('id')->on('users');
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
        Schema::dropIfExists('comments');
    }
}
