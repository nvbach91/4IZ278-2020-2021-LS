<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashcardQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flashcard_questions', function (Blueprint $table) {
            $table->id();
            $table->integer("flashcard_id");
            $table->string("question");
            $table->string("answer");
            $table->string("link_to_external_resource")->nullable();
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
        Schema::dropIfExists('flashcard_questions');
    }
}
