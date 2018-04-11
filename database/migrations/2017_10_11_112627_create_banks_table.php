<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country', 3)->default('PRY');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('code_swift')->nullable();
            $table->string('corresponsal_bank')->nullable();
            $table->string('corresponsal_account')->nullable();
            $table->string('corresponsal_swift')->nullable();
            $table->string('corresponsal_address')->nullable();
            $table->string('corresponsal_city')->nullable();
            $table->string('corresponsal_country')->nullable();
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
        Schema::dropIfExists('banks');
    }
}
