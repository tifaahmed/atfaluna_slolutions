<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('points')->default('0');//[note: "ex ( 5 - 6)"] // get from success

            $table->integer('minimum_requirements')->default('0');//[note: "ex ( 100 - 200)"] // to enter the quiz 

            $table->integer('quizable_id')->nullable(); //[note: 'morphs_id (subject_id , age_group_id)']
            $table->string('quizable_type')->nullable();; //[note: 'morphs_type (subject_model , age_group_model)']
            
            
            $table->integer('quiz_type_id')->unsigned();
            $table->foreign('quiz_type_id')->references('id')->on('quiz_types')->onDelete('cascade');

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
        Schema::dropIfExists('quizzes');
    }
}
