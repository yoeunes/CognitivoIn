<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned()->index();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->integer('profile_id')->unsigned()->comment('Author of Post');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->text('post');
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
        Schema::dropIfExists('team_posts');
    }
}
