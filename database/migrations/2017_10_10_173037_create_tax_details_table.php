<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tax_id')->unsigned()->index();
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->string('name')->nullable();
            $table->decimal('percent', 5, 2)->nullable();
            $table->integer('type')->unsigned()->default(1);
            //$table->enum('type', array('Product' ,'Location', 'Destination'))->default('Product');
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
        Schema::dropIfExists('tax_details');
    }
}
