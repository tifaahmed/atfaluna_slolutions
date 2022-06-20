<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkinlanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skin_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('name');//[note: "ex (  arabic or english or italian -...etc) ,'not null '"]
            $table->string('language');//[note: "ex ( ar-en-it-...etc) , 'not null'"]
            $table->integer('skin_id')->unsigned();
            $table->foreign('skin_id')->references('id')->on('skins')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skin_languages');
    }
}
