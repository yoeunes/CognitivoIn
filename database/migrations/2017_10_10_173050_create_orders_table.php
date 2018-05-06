<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateOrdersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ref_id')->unsigned()->nullable();

            $table->integer('relationship_id')->unsigned();
            $table->foreign('relationship_id')->references('id')->on('relationships');

            $table->integer('recurring_order_id')->unsigned()->nullable();
            $table->foreign('recurring_order_id')->references('id')->on('recurring_orders');

            $table->integer('location_id')->unsigned()->nullable();
            $table->foreign('location_id')->references('id')->on('locations');

            $table->integer('buyer_profile_id')->unsigned()->nullable();
            $table->integer('agent_profile_id')->unsigned()->nullable();

            $table->string('currency', 3);
            $table->decimal('currency_rate', 20, 5);

            $table->tinyInteger('classification')->unsigned()->nullable();

            $table->string('tracking_code')->nullable();

            $table->integer('code')->nullable();
            $table->date('code_expiry')->nullable();
            $table->string('number')->nullable();

            $table->integer('credit_days')->default(0)->nullable();
            $table->dateTime('date')->nullable();
            $table->dateTime('date_deliver_by')->nullable();

            $table->string('comment')->nullable();
            $table->string('note_for_customer')->nullable();
            $table->string('note_for_billing')->nullable();
            $table->string('note_for_shipping')->nullable();
            $table->string('geoloc')->nullable();

            $table->boolean('is_impex')->default(false);
            $table->boolean('is_printed')->default(false);
            $table->boolean('is_archived')->default(false);

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
        Schema::dropIfExists('orders');
    }
}
