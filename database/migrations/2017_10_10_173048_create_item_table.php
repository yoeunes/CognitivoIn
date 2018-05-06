<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateItemTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('items', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->integer('item_id')->unsigned()->nullable();
            $table->foreign('item_id')->references('id')->on('items');

            $table->string('name');
            $table->string('sku')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();

            $table->string('currency', 3);

            $table->decimal('unit_price', 20, 2)->unsigned()->nullable();
            $table->decimal('unit_cost', 20, 2)->unsigned()->nullable();

            $table->boolean('is_active')->default(true);
            //store properties
            $table->boolean('is_private')->default(false)->comment('true = Show only to Approved Relationships; false = Show to everyone');
            $table->boolean('show_price')->default(true);

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
        Schema::dropIfExists('items');
    }
}
