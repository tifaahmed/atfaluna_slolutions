<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUserSkinAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_skin_accessories', function (Blueprint $table) {
            $table->id();

            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users')->onDelete('cascade');
            
            $table->integer('skin_id')->unsigned();
            $table->foreign('skin_id')->references('id')->on('skins')->onDelete('cascade');

            $table->integer('accessory_id')->unsigned();
            $table->foreign('accessory_id')->references('id')->on('accessories')->onDelete('cascade');

            $table->boolean('active') -> default (0) ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_user_skin_accessories');
    }
}
