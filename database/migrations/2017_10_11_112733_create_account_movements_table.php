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

            $table->unsignedInteger('account_id')->index();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');

            $table->unsignedInteger('location_id')->nullable()->index();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->unsignedInteger('schedual_id')->nullable();
            $table->foreign('schedual_id')->references('id')->on('scheduals');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('profiles');

            $table->unsignedTinyInteger('status')->default(1);
            //'Pending' ,'Approved', 'Rejected' ->default('Pending');

            $table->unsignedTinyInteger('type')->default(1);
            //1 = Cash, 2 = Check, 3 = CreditCard, 4 = WireTransfer, 5 = Refund or Credit Note

            $table->string('currency', 3);
            $table->unsignedDecimal('currency_rate', 20, 5);

            $table->date('date');

            $table->unsignedDecimal('debit', 20, 2);
            $table->unsignedDecimal('credit', 20, 2);

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
