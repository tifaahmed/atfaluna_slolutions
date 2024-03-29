<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('governments', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('name')->unique();
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            
            $table -> string        ( 'latitude',50  ) -> nullable( )              ;
            $table -> string        ( 'longitude',50 ) -> nullable( )              ;
            
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     * 
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('governments');
    }
}

