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

        Schema::create('schedule', function (Blueprint $table)
        {
            $table->increments('id');

            $table->unsignedInteger('relationship_id')->nullable();
            $table->foreign('relationship_id')->references('id')->on('relationships');

            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->string('currency', 3);
            $table->decimal('currency_rate', 20, 5)->default(1)->unsigned();

            $table->tinyInteger('classification')->unsigned()->nullable();

            $table->date('date');
            $table->date('due_date');

            $table->decimal('value', 20, 2)->unsigned()->default(0);

            $table->string('reference')->nullable()->comment('Additional to the comment.');
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
        Schema::dropIfExists('scheduals');
    }
}
