<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateRecurringSchedualsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('recurring_scheduals', function (Blueprint $table)
        {
            $table->increments('id');

            //TODO change Item to Type.
            // $table->integer('item_id')->unsigned()->nullable();
            // $table->foreign('item_id')->references('id')->on('items');

            $table->integer('relationship_id')->unsigned()->index();
            $table->foreign('relationship_id')->references('id')->on('relationships');

            $table->string('currency', 3);

            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->decimal('debit', 20, 2)->default(0);
            $table->decimal('credit', 20, 2)->default(0);

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->integer('pay_cycle')->default(30)->unsigned();
            $table->integer('pay_on')->default(1);

            $table->string('note_for_customer')->nullable();
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
        Schema::dropIfExists('recurring_scheduals');
    }
}
