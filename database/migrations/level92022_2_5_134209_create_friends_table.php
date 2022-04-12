<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('id');  //[pk]
            $table->boolean('online'); //[note:'default(0)',note:'true or false'] 
            $table->boolean('accept'); //[note:'default(0)',note:'true or false']
            $table->boolean('block');  //[note:'default(0)',note:'true or false']
            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users')->onDelete('cascade');
            $table->integer('recevier_id')->unsigned();
            $table->foreign('recevier_id')->references('id')->on('sub_users')->onDelete('cascade');
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
        Schema::dropIfExists('friends');
    }
}
