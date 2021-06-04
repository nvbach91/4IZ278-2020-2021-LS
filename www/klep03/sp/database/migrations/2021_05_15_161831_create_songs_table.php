<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique;
            $table->longText('lyrics_w_chords');
            $table->string('artist');
            $table->enum('difficulty', array('beginner', 'easy', 'medium', 'hard'))->nullable();
            // $table->unsignedBigInteger('created_by');
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('style');
            $table->foreignId('style')->nullable()->references('id')->on('styles');
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
        Schema::dropIfExists('songs');
    }
}
