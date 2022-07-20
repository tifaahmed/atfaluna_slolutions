<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchAnswerlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_answer_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('title');//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('audio')->nullable();
            $table->string('language');//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('match_answer_id')->unsigned();
            $table->foreign('match_answer_id')->references('id')->on('match_answers')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_answer_languages');
    }
}
