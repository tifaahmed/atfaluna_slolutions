<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqAnswerlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_answer_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('title');//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('language');//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('mcq_answer_id')->unsigned();
            $table->foreign('mcq_answer_id')->references('id')->on('mcq_answers')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mcq_answer_languages');
    }
}
