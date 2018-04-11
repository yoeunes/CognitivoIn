<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_teams', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->integer('team_id')->unsigned()->index();
            $table->foreign('team_id')->references('id')->on('teams');

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
        Schema::dropIfExists('profile_teams');
    }
}
