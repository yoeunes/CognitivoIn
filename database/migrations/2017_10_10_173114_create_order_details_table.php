<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateOrderDetailsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
          Schema::create('order_details', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('ref_id')->unsigned()->nullable();

            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('profiles');

            $table->integer('cart_id')->unsigned()->nullable();
            $table->foreign('cart_id')->references('id')->on('carts');

            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->integer('tax_id')->unsigned()->nullable();
            $table->foreign('tax_id')->references('id')->on('taxes');

            $table->string('item_sku')->nullable();
            $table->string('item_name');

            $table->decimal('quantity', 20, 5)->nullable();
            $table->decimal('unit_price', 20, 5)->nullable();
            $table->decimal('unit_cost', 20, 5)->nullable();

            $table->string('comment')->nullable();

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
        Schema::dropIfExists('order_details');
    }
}
