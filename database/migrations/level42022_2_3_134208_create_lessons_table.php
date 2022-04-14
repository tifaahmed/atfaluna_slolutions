<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('points')->default('0');//[note: "ex ( 5 - 6)"]
            
            $table->integer('sub_subject_id')->unsigned();
            $table->foreign('sub_subject_id')->references('id')->on('sub_subjects')->onDelete('cascade');

            $table->integer('lesson_type_id')->unsigned();
            $table->foreign('lesson_type_id')->references('id')->on('lesson_types')->onDelete('cascade');
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
        Schema::dropIfExists('lessons');
    }
}
