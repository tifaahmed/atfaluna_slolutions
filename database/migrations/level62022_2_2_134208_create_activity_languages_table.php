<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('name');//[note: "ex (  arabic or english or italian  -...etc) ,'not null'"]
            $table->string('image_one'); //[not null]
            $table->string('image_two'); //[not null]
            $table->string('url'); //[not null]
            $table->string('language',2);//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('activity_id')->unsigned();
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');  
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
        Schema::dropIfExists('activity_languages');
    }
}
