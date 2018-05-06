<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateRecurringordersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('recurring_orders', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('relationship_id')->unsigned()->index();
            $table->foreign('relationship_id')->references('id')->on('relationships');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('profiles');

            $table->integer('tax_id')->unsigned()->nullable();
            $table->foreign('tax_id')->references('id')->on('taxes');

            $table->string('currency', 3);

            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->text('comment')->nullable();

            $table->string('contract_number')->nullable();

            $table->decimal('unit_price', 20, 2)->nullable();

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('bill_cycle')->default(30)->unsigned();
            $table->integer('bill_on')->default(1);

            $table->string('note_for_customer')->nullable();
            $table->string('note_for_billing')->nullable();
            $table->string('note_for_shipping')->nullable();

            $table->boolean('for_sales')->default(true);
            $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('recurring_orders');
    }
}
