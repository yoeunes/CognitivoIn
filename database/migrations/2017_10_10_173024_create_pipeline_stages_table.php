<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreatePipelineStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pipeline_stages', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pipeline_id')->unsigned()->index();
            $table->foreign('pipeline_id')->references('id')->on('pipelines')->onDelete('cascade');

            $table->unsignedTinyInteger('activity_type')->nullable()->after('sequence');

            $table->decimal('completed', 4, 2);
            $table->integer('sequence');
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
        Schema::dropIfExists('pipeline_stages');
    }
}
