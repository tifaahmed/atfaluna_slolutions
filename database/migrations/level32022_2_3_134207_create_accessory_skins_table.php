
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessorySkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessory_skins', function (Blueprint $table) {
            $table->integer('accessory_id')->unsigned();
            $table->foreign('accessory_id')->references('id')->on('accessories');
            $table->integer('skin_id')->unsigned();
            $table->foreign('skin_id')->references('id')->on('skins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessory_skins');
    }
}
