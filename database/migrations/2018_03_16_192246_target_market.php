<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TargetMarket extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('target_markets', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('targetable_id')->unsigned();
            $table->integer('targetable_type')->unsigned();
            $table->string('target', 128);
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('target_markets');
    }
}
