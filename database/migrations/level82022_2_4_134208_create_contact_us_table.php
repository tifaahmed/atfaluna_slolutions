<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('name')-> nullable( );//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('message')-> nullable( );//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('subject')-> nullable( );//[note: "ex (  arabic or english or italian -...etc)"]
            $table->string('email')-> nullable( ) ;
            $table->boolean('status')-> default (0); //read or not 
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
        Schema::dropIfExists('contact_us');
    }
}
