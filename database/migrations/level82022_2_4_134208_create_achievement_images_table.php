<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievement_images', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->integer('points')->default('0');//[note: "ex ( 5 - 6)"]
            $table->integer('achievement_id')->unsigned();
            $table->foreign('achievement_id')->references('id')->on('achievements')->onDelete('cascade');
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
        Schema::dropIfExists('achivement_images');
    }
}
