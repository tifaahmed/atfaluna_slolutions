<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('image')->nullable();
            $table->string('name');//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('language',2);//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('quiz_id')->unsigned();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_languages');
    }
}
