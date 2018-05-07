<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemPromotionsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('item_promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('type')->comment('Enum based promotion type');

            $table->morphs('inputs');
            $table->unsignedDecimal('input_value', 8, 2);

            $table->morphs('outputs');
            $table->unsignedDecimal('output_value', 8, 2);

            $table->morphs('start_date');
            $table->morphs('end_date');

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
        Schema::dropIfExists('item_promotions');
    }
}
