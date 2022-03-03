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
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('avatar_id')->unsigned();
            $table->foreign('avatar_id')->references('id')->on('avatars');
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
