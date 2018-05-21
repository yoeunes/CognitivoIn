<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOpportunity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('opportunities', function (Blueprint $table) {
            $table->unsignedInteger('profile_id')->nullable()->after('id');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');

            $table->string('currency', 3)->after('value');
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
