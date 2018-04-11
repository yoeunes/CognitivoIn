<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class CreateOpportunitiesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('relationship_id')->unsigned()->index();
            $table->foreign('relationship_id')->references('id')->on('relationships');

            $table->integer('pipeline_stage_id')->unsigned()->index();
            $table->foreign('pipeline_stage_id')->references('id')->on('pipeline_stages')->onDelete('cascade');

            $table->date('deadline_date')->nullable();

            $table->text('description')->nullable();

            $table->integer('status')->unsigned()->default(1)->comment('0 = Inactive; 1 = Active; 2 = On Hold; 3 = Won; 4 = Lost');
            $table->decimal('value', 20, 2)->unsigned()->nullable();

            $table->boolean('is_archived')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->integer('creatd_by')->unsigned()->index()->nullable();
            $table->foreign('creatd_by')->references('id')->on('profiles');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('opportunities');
    }
}
