<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_user_subscriptions', function (Blueprint $table) {
            $table->increments('id');//[pk]

            $table->integer('sub_user_id')->unsigned();
            $table->foreign('sub_user_id')->references('id')->on('sub_users')->onDelete('cascade');

            $table->date('start')->default( date('Y-m-d') ); //[note:'1-1-2022']
            $table->date('end'); //[note:'1-2-2010']

            $table->decimal('price')->default( 0 ); //[note:'2']

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
        Schema::dropIfExists('sub_user_subscriptions');
    }
}
