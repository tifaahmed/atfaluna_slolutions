<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_languages', function (Blueprint $table) {
            $table->string('url'); //[not null]
            $table->string('image'); //[not null]
            $table->string('name');//[note: "ex (  arabic or english or italian -...etc) ,'not null'"]
            $table->string('language',2);//[note: "ex ( ar-en-it-...etc) , 'not null'"]
            $table->integer('lesson_id')->unsigned();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_languages');
    }
}
