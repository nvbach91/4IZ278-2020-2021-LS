<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("favorite_collections", function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("flashcard_collection_id");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("flashcard_collection_id")->references("id")->on("flashcard_collections");
        });

        Schema::create("favorite_flashcards", function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("flashcard_id");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("flashcard_id")->references("id")->on("flashcards");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("favorite_flashcards");
        Schema::dropIfExists("favorite_collections");
    }
}
