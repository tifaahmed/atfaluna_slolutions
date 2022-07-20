<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchQuestionsTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_questions', function (Blueprint $table) {
            $table->increments('id');//[pk]
            $table->integer('degree')->default('0');//[note: "ex ( 5 - 6)"]
            // $table->enum('level',['hard','medium','easy'])->default('easy');
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
        Schema::dropIfExists('match_questions');
    }
}
