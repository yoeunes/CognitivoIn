<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileInformationsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('profile_informations', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->integer('type')->unsigned()->default(1)->comment('Telephone, Mobile, Address, Email, Website, Profile, Diploma or Degree, Job Description');
            $table->string('name');
            $table->string('data');
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
        Schema::dropIfExists('profile_informations');
    }
}
