<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubjectLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_subject_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('image_one')->nullable(); 
            $table->string('image_two')->nullable(); 
            $table->string('name')->nullable();//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('description')->nullable();//[note: "ex (  arabic or english or italian -...etc)"]

            $table->string('language',2);//[note: "ex ( ar-en-it-...etc)"]

            $table->integer('sub_subject_id')->unsigned();
            $table->foreign('sub_subject_id')->references('id')->on('sub_subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_subject_languages');
    }
}
