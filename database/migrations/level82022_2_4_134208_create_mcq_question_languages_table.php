<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqQuestionlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcq_question_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('title')->notnull();//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('language')->notnull();//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('mcq_question_id')->unsigned();
            $table->foreign('mcq_question_id')->references('id')->on('mcq_questions')->onDelete('cascade');
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
        Schema::dropIfExists('mcq_question_languages');
    }
}
