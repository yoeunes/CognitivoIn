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

            $table->unsignedInteger('pipeline_stage_id')->nullable();
            $table->foreign('pipeline_stage_id')->references('id')->on('pipeline_stages')->onDelete('cascade');

            $table->integer('sentiment')->unsigned()->default(1);
            //$table->enum('sentiment', array('Good' ,'Bad', 'N/A'));

            $table->dateTime('date_reminder')->nullable();
            $table->dateTime('date_started')->nullable();
            $table->dateTime('date_ended')->nullable();

            $table->string('title');
            $table->text('description')->nullable();

            $table->string('geoloc')->nullable();

            $table->boolean('completed')->default(false);
            $table->dateTime('completed_at')->nullable();
            $table->unsignedInteger('completed_by')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('assigned_to')->nullable();

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
        Schema::dropIfExists('opportunity_tasks');
    }
}
