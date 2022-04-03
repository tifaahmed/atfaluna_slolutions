<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_questionables', function (Blueprint $table) {
            $table->increments('id');//[pk]

            $table->integer('quiz_id')->unsigned();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

            $table->integer('position')->default(0);

            $table->integer('quiz_questionable_id'); //[note: 'morphs_id (mcq_questions_id , true_false_question_id)']
            $table->string('quiz_questionable_type'); //[note: 'morphs_type (Mcq_question , True_false_question)']
            
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
        Schema::dropIfExists('quiz_questionables');
    }
}
