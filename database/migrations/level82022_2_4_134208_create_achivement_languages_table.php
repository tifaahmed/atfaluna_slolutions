<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchivementlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achivement_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('name');//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('description')->nullable();//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('language',2);//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('achievement_id')->unsigned();
            $table->foreign('achievement_id')->references('id')->on('achievements');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achivement_languages');
    }
}
