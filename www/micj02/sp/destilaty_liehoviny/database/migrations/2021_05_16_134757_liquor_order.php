<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LiquorOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creates_liquor_order_pivot_table', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('liquor_id');
            $table->unsignedBigInteger('order_id');

            $table->index('liquor_id');
            $table->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creates_liquor_order_pivot_table');
    }
}
