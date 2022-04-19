<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_times', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->enum('day',[1,2,3,4,5,6,0]);
            $table->boolean('status'); //[default:1 , note: '0 off , 1 on']
            $table->time('start');//[note: 'time only']
            $table->time('end');//[note: 'time only']
            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users');
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
        Schema::dropIfExists('play_times');
    }
}

