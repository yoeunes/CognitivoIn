<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateItemReviewsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('item_reviews', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items');

            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->tinyInteger('stars');
            $table->string('sentiment', 10)->nullable();

            $table->string('review');

            $table->boolean('is_verified')->default(false);

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
        Schema::dropIfExists('item_reviews');
    }
}
