<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('image'); //[not null]
            $table->unsignedDecimal('price'); //[not null]
            $table->enum('gender',['girl','boy','both']); //[note: 'boys or girls or both '] 

            $table->integer('body_suit_id')->unsigned();
            $table->foreign('body_suit_id')->references('id')->on('body_suits');

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
        Schema::dropIfExists('accessories');
    }
}
