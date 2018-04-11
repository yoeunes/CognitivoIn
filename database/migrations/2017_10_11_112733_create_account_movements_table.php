<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateAccountMovementsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('account_movements', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('schedual_id')->unsigned()->nullable();
            $table->foreign('schedual_id')->references('id')->on('scheduals');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('profiles');

            $table->integer('status')->unsigned()->default(1);
            //$table->enum('status', array('Pending' ,'Approved', 'Rejected'))->default('Pending');

            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');

            $table->tinyInteger('type_id')->unsigned();
            //1 = Cash, 2 = Check, 3 = CreditCard, 4 = WireTransfer, 5 = Refund or Credit Note
            //$table->foreign('type_id')->references('id')->on('payment_types')->onDelete('cascade');

            $table->integer('currency_id')->unsigned();
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->decimal('currency_rate',  20, 2);

            $table->date('date');

            $table->decimal('debit', 20, 2);
            $table->decimal('credit', 20, 2);

            $table->string('comment')->nullable();
            $table->string('reference')->nullable()->comment('Store Payment Number');

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
        Schema::dropIfExists('account_movements');
    }
}
