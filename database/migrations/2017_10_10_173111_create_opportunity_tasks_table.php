<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateOpportunityTasksTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('opportunity_tasks', function (Blueprint $table)
        {
            $table->increments('id');

            $table->unsignedTinyInteger('activity_type')->index();

            $table->integer('opportunity_id')->unsigned()->index();
            $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade');

            $table->integer('sentiment')->unsigned()->default(1);
            //$table->enum('sentiment', array('Good' ,'Bad', 'N/A'));

            $table->dateTime('reminder_date')->nullable();
            $table->timestamp('date_started')->useCurrent = true;
            $table->dateTime('date_ended')->nullable();

            $table->string('title');
            $table->text('description')->nullable();

            $table->string('geoloc')->nullable();

            $table->boolean('completed')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('assigned_to')->unsigned()->nullable();
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('opportunity_tasks');
    }
}