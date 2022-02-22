<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('name')->unique();
            $table->integer('government_id')->unsigned();
            $table->foreign('government_id')->references('id')->on('governments');
            // $table->foreignId('government_id')->nullable()->default('1')->constrained()->nullOnDelete()->cascade();
            $table->softDeletes();
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
        Schema::dropIfExists('cities');
    }
}

