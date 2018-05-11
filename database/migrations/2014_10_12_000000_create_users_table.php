<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('slug', 128)->unique('slug')->index();
            $table->tinyInteger('type')->default(1)->nullable();
            $table->string('poster_img')->nullable();
            $table->string('profile_img')->nullable();

            $table->string('name');
            $table->string('alias')->nullable();
            $table->string('taxid')->nullable();

            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('country', 3)->nullable()->default('PRY');
            $table->string('zip', 11)->nullable();
            $table->string('geoloc')->nullable();
            $table->string('currency', 3);

            $table->string('short_description', 128)->nullable()->comment('short_descrp = Company. job_title = User');
            $table->text('long_description')->nullable();

            $table->boolean('is_private')->default(false)->comment('true = Show only to Approved Relationships; false = Show to everyone');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table)
        {
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');

            $table->string('email')->unique();
            $table->string('google_id')->nullable();
            $table->string('password')->nullable();

            $table->string('provider', 20)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('access_token')->nullable();

            //User Settings
            $table->string('lang', 2)->nullable();
            $table->string('country', 3)->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('timezone')->nullable();

            $table->tinyInteger('gender')->unsigned()->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('profile_settings', function (Blueprint $table)
        {
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->tinyInteger('industry')->nullable();
            $table->tinyInteger('sub_industry')->nullable();

            $table->tinyInteger('show_prices_to')->default(5)
            ->comment('Mark the highest role number allowed, example if 5 then all users can see. If 1 then only Admins can see the price.');

            $table->boolean('show_products')->default(true);

            $table->timestamps();
        });

        Schema::create('profile_interests', function (Blueprint $table)
        {
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->tinyInteger('interest');

            $table->timestamps();
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('profile_interests');
        Schema::dropIfExists('profile_settings');
        Schema::dropIfExists('users');
        Schema::dropIfExists('profiles');
    }
}
