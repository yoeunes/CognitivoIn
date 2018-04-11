<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('profiles');
            $table->tinyInteger('stars');
            $table->longText('review')->nullable();
            $table->boolean('is_anonymous')->default(false)->comment('This allows people to say things anonymously, but regardless should still save who said it. To avoid spam.');
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
        Schema::dropIfExists('profile_reviews');
    }
}
