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

            $table->nullableMorphs('input');
            $table->unsignedDecimal('input_value', 8, 2);

            $table->nullableMorphs('output');
            $table->unsignedDecimal('output_value', 8, 2);

            $table->date('start_date');
            $table->date('end_date');

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
