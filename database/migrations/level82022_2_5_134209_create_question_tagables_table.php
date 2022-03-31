<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTagablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_tagables', function (Blueprint $table) {
            $table->increments('id');//[pk]

            $table->integer('question_tag_id')->unsigned();
            $table->foreign('question_tag_id')->references('id')->on('question_tags')->onDelete('cascade');

            $table->integer('position')->default(0);

            $table->integer('question_tagables_id'); //[note: 'morphs_id (mcq_questions_id , true_false_question_id)']
            $table->string('question_tagables_type'); //[note: 'morphs_type (Mcq_question , True_false_question)']
            
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
        Schema::dropIfExists('question_tagables');
    }
}
