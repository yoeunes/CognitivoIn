<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateItemFaqsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('item_faqs', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items');

            $table->integer('item_faq_id')->unsigned()->index()->nullable();
            $table->foreign('item_faq_id')->references('id')->on('item_faqs');

            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->tinyInteger('type')->default(1)->comment('1 = Question; 2 = Answer');
            $table->string('comment');

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
        Schema::dropIfExists('item_faqs');
    }
}
