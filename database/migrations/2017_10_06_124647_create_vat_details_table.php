<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVatDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vat_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('vat_id')->unsigned()->index();
            $table->foreign('vat_id')->references('id')->on('vats')->onDelete('cascade');

            $table->unsignedDecimal('coefficient', 4, 4);
            $table->unsignedDecimal('percent', 5, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vat_details');
    }
}
