<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('relation_id')->cascade(); //[note: 'cascade ,morphs_id (subject_id , age_group_id)']
            $table->string('relation_type')->cascade(); //[note: 'cascade, morphs_type (subject_model , age_group_model)']
            $table->string('image_one'); //[note: 'not null']
            $table->string('image_two'); //[note: 'not null']
            $table->integer('min_point');
            $table->integer('max_point');
            //// $table->morphs('taggable');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->integer('sub_users_id')->unsigned();
            $table->foreign('sub_users_id')->references('id')->on('sub_users');
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
        Schema::dropIfExists('certificates');
    }
}
