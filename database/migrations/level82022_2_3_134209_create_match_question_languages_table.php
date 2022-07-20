<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchQuestionlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_question_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('audio')->nullable();
            $table->string('header')->nullable();//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('language',2);//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('match_question_id')->unsigned();
            $table->foreign('match_question_id')->references('id')->on('match_questions')->onDelete('cascade');
        });
    }
    
    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_question_languages');
    }
}
