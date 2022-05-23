<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skillables', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->integer('skillable_id')->nullable(); //[note: 'morphs_id (subject_id , sub_subject_id ,lesson_id)']
            $table->string('skillable_type')->nullable();; //[note: 'morphs_type (subject_model , sub_subject_model ,lesson_model)']
            
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
        Schema::dropIfExists('skillables');
    }
}
