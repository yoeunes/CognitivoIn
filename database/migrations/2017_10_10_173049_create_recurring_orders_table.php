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

            $table->unsignedInteger('relationship_id')->index();
            $table->foreign('relationship_id')->references('id')->on('relationships');

            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('profiles');

            $table->unsignedInteger('vat_id')->nullable();
            $table->foreign('vat_id')->references('id')->on('vats')->onDelete('cascade');

            $table->unsignedInteger('item_id')->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->string('currency', 3);

            $table->text('comment')->nullable();

            $table->string('contract_number')->nullable();
            $table->integer('contract_id')->unsigned()->nullable()->comment('nullable = cash. non null = credit.');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');

            $table->unsignedDecimal('unit_price', 20, 2)->nullable();

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->unsignedTinyInteger('bill_every')->default(30)->unsigned();
            $table->unsignedTinyInteger('bill_on')->default(1);

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
