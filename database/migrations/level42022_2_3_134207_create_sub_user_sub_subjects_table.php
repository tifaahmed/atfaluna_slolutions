<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUserSubSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_sub_subjects', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users')->onDelete('cascade');
            $table->integer('sub_subject_id')->unsigned();
            $table->foreign('sub_subject_id')->references('id')->on('sub_subjects')->onDelete('cascade');
            $table->integer('points') -> default (0) ;
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_user_sub_subjects');
    }
}
