
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUserSkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_skins', function (Blueprint $table) {
            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users');
            $table->integer('skin_id')->unsigned();
            $table->foreign('skin_id')->references('id')->on('skins');
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
        Schema::dropIfExists('sub_user_skins');
    }
}
