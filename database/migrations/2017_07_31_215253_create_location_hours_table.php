<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationHoursTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('location_hours', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('location_id')->unsigned()->index();
            $table->foreign('location_id')->references('id')->on('locations');

            $table->integer('day')->unsigned()->default(1)
            ->comment('
            1 = Weekdays;
            2 = Weekends;
            3 = Monday;
            4 = Tuesday;
            5 = Wednesday;
            6 = Thursday;
            7 = Friday;
            8 = Saturday;
            9 = Sunday;');
            $table->time('open_time');
            $table->time('close_time');
            $table->boolean('open_holidays')->default(false);
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
        Schema::dropIfExists('location_hours');
    }
}
