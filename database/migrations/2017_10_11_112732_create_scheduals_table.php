<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateSchedualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('scheduals', function (Blueprint $table)
        {
            $table->increments('id');

            // $table->integer('status')->unsigned()->default(1);
            //$table->enum('status', array('Pending' ,'Approved', 'Rejected'))->default('Pending');

            // $table->integer('recurring_schedual_id')->unsigned()->nullable()->comment('Some scheduals can be grouped together for printing by creating a Group ID.');
            // $table->foreign('recurring_schedual_id')->references('id')->on('recurring_scheduals')->onDelete('cascade');

            // $table->integer('payment_detail_id')->unsigned()->nullable()->comment('Optional One-to-One relationship with Payment Detail. This helps counter the balance.');
            // $table->foreign('payment_detail_id')->references('id')->on('payment_details')->onDelete('cascade');

            // $table->integer('parent_id')->unsigned()->nullable();
            // $table->foreign('parent_id')->references('id')->on('scheduals')->onDelete('cascade');

            $table->integer('relationship_id')->unsigned();
            $table->foreign('relationship_id')->references('id')->on('relationships');

            // $table->integer('user_id')->unsigned()->index();
            // $table->foreign('user_id')->references('id')->on('profiles');

            $table->integer('currency_id')->unsigned();
            $table->foreign('currency_id')->references('id')->on('currencies');

            $table->decimal('rate',  20, 2);

            $table->tinyInteger('classification')->unsigned()->nullable();

            $table->date('date');
            $table->date('date_exp');

            $table->decimal('debit', 20, 2)->default(0);
            $table->decimal('credit', 20, 2)->default(0);

            $table->string('reference')->nullable()->comment('Additional to the comment.');
            $table->string('comment')->nullable();
            // $table->boolean('is_payable')->default(true);

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
        Schema::dropIfExists('scheduals');
    }
}
