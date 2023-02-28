<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skins', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('image');
            $table->unsignedDecimal('price') -> default (0); //[not null]
            $table->boolean('original') -> default (0) ;

            $table->integer('avatar_id')->unsigned();
            $table->foreign('avatar_id')->references('id')->on('avatars')->onDelete('cascade');

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
        Schema::dropIfExists('skins');
    }

}
