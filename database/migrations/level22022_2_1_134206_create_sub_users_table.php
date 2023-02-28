<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_users', function (Blueprint $table) {
            $table->increments('id');//[pk]
            
            $table->string('name'); //[note: 'not null']
            $table->integer('age')->nullable();
            $table->enum('gender',['girl','boy']);
            $table->integer('points')->default(0); 

            $table -> string        ( 'latitude',50  ) -> nullable( )              ;
            $table -> string        ( 'longitude',50 ) -> nullable( )              ;
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('sub_users');
    }

}
