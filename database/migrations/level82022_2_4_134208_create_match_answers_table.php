<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_answers', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('image')->nullable();
            $table->enum('possition',['top','bottom']);

            $table->integer('match_answer_id')->nullable()->unsigned();
            $table->foreign('match_answer_id')->references('id')->on('match_answers');

            $table->integer('match_question_id')->unsigned();
            $table->foreign('match_question_id')->references('id')->on('match_questions');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_answers');
    }
}
