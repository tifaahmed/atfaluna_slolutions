<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodySuitHumanPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_suit_human_parts', function (Blueprint $table) {
            $table->id();
            $table->integer('body_suit_id')->unsigned();
            $table->foreign('body_suit_id')->references('id')->on('body_suits')->onDelete('cascade');

            $table->integer('human_part_id')->unsigned();
            $table->foreign('human_part_id')->references('id')->on('human_parts')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('body_suits_human_parts');
    }
}
