<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUseravatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_avatars', function (Blueprint $table) {
            $table->integer('sub_users_id')->unsigned();
            $table->foreign('sub_users_id')->references('id')->on('sub_users')->onDelete('cascade');
            $table->integer('avatar_id')->unsigned();
            $table->foreign('avatar_id')->references('id')->on('avatars')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_user_avatars');
    }

}

