<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateCartsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {

        Schema::create('carts', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('buyer_profile_id')->unsigned()->nullable();
            $table->integer('agent_profile_id')->unsigned()->nullable();

            $table->integer('relationship_id')->unsigned();
            $table->foreign('relationship_id')->references('id')->on('relationships');

            $table->integer('opportunity_id')->unsigned()->index()->nullable();
            $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade');

            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');

            $table->integer('item_promotion_id')->unsigned()->index()->nullable();
            $table->foreign('item_promotion_id')->references('id')->on('item_promotions')->onDelete('cascade');

            $table->integer('status')->unsigned()->default(1)->comment('0 = OnHold; 1 = Pending; 2 = Proccessed; 3 = Rejected');

            $table->decimal('quantity', 20, 5)->default(1)->nullable();
            $table->decimal('unit_price', 20, 5)->nullable();

            $table->integer('vat_id')->unsigned()->index()->nullable();
            $table->foreign('vat_id')->references('id')->on('vats')->onDelete('cascade');

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
        Schema::dropIfExists('carts');
    }
}
