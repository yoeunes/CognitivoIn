<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateItemPropertiesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('item_properties', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items');

            $table->tinyInteger('type')->default(1)->comment('1 = Weight; 2 = Dimensions; 3 = General');
            $table->string('property');
            $table->string('value');

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
        Schema::dropIfExists('item_properties');
    }
}
