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
            $table->integer('certificatable_id')->nullable(); //[note: 'morphs_id (subject_id , age_group_id)']
            $table->string('certificatable_type')->nullable(); //[note: 'morphs_type (subject_model , age_group_model)']
            $table->string('image_one'); //[note: 'not null']
            $table->string('image_two'); //[note: 'not null']
            $table->integer('min_point')->default( 0 );
            $table->integer('max_point')->default( 0 );

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
