<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->string('name');

            $table->string('telephone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 16)->nullable();
            $table->string('country', 3)->default('PRY');
            $table->string('zip', 11)->nullable();

            $table->string('geoloc')->nullable();

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
        Schema::dropIfExists('locations');
    }
}
