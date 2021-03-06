<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUseravatarsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sub_user_avatars', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users')->onDelete('cascade');
            $table->integer('avatar_id')->unsigned();
            $table->foreign('avatar_id')->references('id')->on('avatars')->onDelete('cascade');
            $table->integer('active')->default(0);

        });
    }
    /**
     */
    public function down()
    {
        Schema::dropIfExists('sub_user_avatars');
    }

}