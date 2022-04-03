<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgeGrouplanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_group_languages', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('name')->unique();;//[note: "ex (  arabic or english or italian  -...etc)"]
            $table->string('language',2);//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('age_group_id')->unsigned();
            $table->foreign('age_group_id')->references('id')->on('age_groups')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('age_group_languages');
    }
}
