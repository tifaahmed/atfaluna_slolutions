<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkilllanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('name')->unique();//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('language');//[note: "ex ( ar-en-it-...etc)"]
            $table->string('image')->nullable(); //[not null]
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_languages');
    }
}

