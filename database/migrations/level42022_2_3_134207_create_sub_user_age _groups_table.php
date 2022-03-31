<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUserAgeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_age_groups', function (Blueprint $table) {
            $table->integer('sub_users_id')->unsigned();
            $table->foreign('sub_users_id')->references('id')->on('sub_users');
            $table->integer('age_group_id')->unsigned();
            $table->foreign('age_group_id')->references('id')->on('age_groups')->onDelete('cascade');
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
        Schema::dropIfExists('sub_user_age _groups');
    }
}
