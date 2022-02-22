<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatelanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate_languages', function (Blueprint $table) {
            $table->string('title_one');//[note: "ex (  arabic or english or italian  -...etc) ,'not null'"]
            $table->string('title_two');//[note: "ex (  arabic or english or italian -...etc) , 'not null'"]
            $table->string('subject');//[note: "ex (  arabic or english or italian  -...etc) , 'not null'"]
            $table->string('language');//[note: "ex ( ar-en-it-...etc)"]
            $table->integer('certificate_id')->unsigned();
            $table->foreign('certificate_id')->references('id')->on('certificates')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate_languages');
    }
}
