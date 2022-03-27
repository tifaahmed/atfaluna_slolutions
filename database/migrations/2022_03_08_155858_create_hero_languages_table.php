<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('title');//[note: "ex (  arabic or english or italian  -...etc) ,'not null'"]
            $table->string('image'); //[not null]
            $table->string('description')->nullable();//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('language',2);//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('hero_id')->unsigned();
            $table->foreign('hero_id')->references('id')->on('heroes')->onDelete('cascade');           
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
        Schema::dropIfExists('hero_languages');
    }
}
