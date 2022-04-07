<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('massages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('recevier_id');
            $table->string('text'); //[note: "not null"]
            $table->integer('massagable_id'); //[note: 'morphs_id (avatar_id , hero_id ,massage_image_id)']
            $table->string('massagable_type'); //[note: 'morphs_type (avatar_model , hero_model , massage_image_model)']
            $table->integer('conversation_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('conversation')->onDelete('cascade');
            $table->integer('massage_image_id')->unsigned();
            $table->foreign('massage_image_id')->references('id')->on('massage_images')->onDelete('cascade');
            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users')->onDelete('cascade');
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
        Schema::dropIfExists('massages');
    }
}
