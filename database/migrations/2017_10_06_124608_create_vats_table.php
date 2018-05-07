<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateVatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vats', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('profile_id')->unsigned()->index()->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->string('country', 3)->default('USA');
            $table->unsignedTinyInteger('applied_on')->comment('Enum based promotion type');

            $table->string('name');

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
        Schema::dropIfExists('vats');
    }
}
