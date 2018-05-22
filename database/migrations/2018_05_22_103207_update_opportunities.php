<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOpportunities extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('opportunities', function (Blueprint $table)
        {
            $table->unsignedInteger('relationship_id')->nullable()->change();

            $table->dropForeign(['pipeline_stage_id']);

            $table->unsignedInteger('pipeline_id')->nullable()->after('relationship_id');
            $table->foreign('pipeline_id')->references('id')->on('pipelines')->onDelete('cascade');

            $table->string('name')->nullable()->after('deadline_date');
        });

        Schema::table('opportunity_tasks', function (Blueprint $table)
        {
            $table->unsignedInteger('pipeline_stage_id')->nullable()->after('opportunity_id');
            $table->foreign('pipeline_stage_id')->references('id')->on('pipeline_stages')->onDelete('cascade');

            $table->timestamp('completed_at')->nullable()->after('completed');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        //
    }
}
