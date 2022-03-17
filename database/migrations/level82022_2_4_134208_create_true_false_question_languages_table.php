<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrueFalseQuestionlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('true_false_question_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('title');//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('language');//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('true_false_question_id')->unsigned();
            $table->foreign('true_false_question_id')->references('id')->on('true_false_questions');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('true_false_question_languages');
    }
}
