<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smiles', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('avatar_id')->unsigned();
            $table->foreign('avatar_id')->references('id')->on('avatars')->onDelete('cascade');
            $table->integer('hero_id')->unsigned();
            $table->foreign('hero_id')->references('id')->on('heroes')->onDelete('cascade');
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
        Schema::dropIfExists('smiles');
    }
}
