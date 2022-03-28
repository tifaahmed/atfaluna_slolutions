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
            $table->integer('points')->default('0');//[note: "ex ( 5 - 6)"]

            $table->integer('quizable_id'); //[note: 'morphs_id (subject_id , age_group_id)']
            $table->string('quizable_type'); //[note: 'morphs_type (subject_model , age_group_model)']
            
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
