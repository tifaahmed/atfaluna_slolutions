<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUserAvatarAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_avatar_accessories', function (Blueprint $table) {
            $table->increments('id');//[pk]

            $table->integer('sub_user_avatar_id')->unsigned();
            $table->foreign('sub_user_avatar_id')->references('id')->on('sub_user_avatars')->onDelete('cascade');
            
            $table->integer('sub_user_accessory_id')->unsigned();
            $table->foreign('sub_user_accessory_id')->references('id')->on('sub_user_accessories')->onDelete('cascade');

            // $table->boolean('active') -> default (0) ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_user_avatar_accessories');
    }
}
