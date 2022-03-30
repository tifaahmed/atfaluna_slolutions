<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrueFalseQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('true_false_questions', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->string('image')->nullable();
            $table->integer('degree')->default('0');//[note: "ex ( 5 - 6)"]
            $table->enum('level',['hard','medium','easy'])->default('easy');
            $table->boolean('answer')->default('0'); //[default:false]            
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
        Schema::dropIfExists('true_false_questions');
    }
}
