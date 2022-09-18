<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUserMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_messages', function (Blueprint $table) {
            $table->id();
            
            $table->integer('massage_id')->unsigned();
            $table->foreign('massage_id')->references('id')->on('massages')->onDelete('cascade');

            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users')->onDelete('cascade');
            
            $table->boolean('read')->default('0'); //[note:'default(0)',note:'true or false']

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
        Schema::dropIfExists('sub_user_messages');
    }
}
