<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoundablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soundables', function (Blueprint $table) {
            $table->increments('id');//[pk]

            $table->integer('sound_id')->unsigned();
            $table->foreign('sound_id')->references('id')->on('sounds')->onDelete('cascade');

            $table->morphs('soundable');//[note:'morphs_type (Subjects)']

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
        Schema::dropIfExists('soundables');
    }
}
