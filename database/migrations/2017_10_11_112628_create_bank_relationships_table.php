<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateBankRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('bank_relationships', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');

            $table->string('branch_name');
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->string('acc_manager')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();

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
        Schema::dropIfExists('bank_relationships');
    }
}
