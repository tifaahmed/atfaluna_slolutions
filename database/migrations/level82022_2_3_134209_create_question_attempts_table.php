<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_attempts', function (Blueprint $table) {
            $table->increments('id');//[pk]

            $table->integer('quiz_attempt_id')->unsigned();
            $table->foreign('quiz_attempt_id')->references('id')->on('quiz_attempts')->onDelete('cascade');

            $table->enum('status',['closed','open'])->default('open');
            $table->boolean('answer')->default('0'); //[default:false]            

            $table->integer('questionable_id'); //[note: 'morphs_id (mcq_questions_id , true_false_question_id)']
            $table->string('questionable_type'); //[note: 'morphs_type (Mcq_question , True_false_question)']
            
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
        Schema::dropIfExists('question_attempts');
    }
}
