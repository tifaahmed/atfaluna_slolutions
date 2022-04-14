<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->increments('id');//[pk]

            $table->integer('sub_user_quiz_id')->unsigned();
            $table->foreign('sub_user_quiz_id')->references('id')->on('sub_user_quizzes')->onDelete('cascade');

            
            $table->integer('score')->default('0');

            $table->enum('status',['closed','open'])->default('open');

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
        Schema::dropIfExists('quiz_attempts');
    }
}
