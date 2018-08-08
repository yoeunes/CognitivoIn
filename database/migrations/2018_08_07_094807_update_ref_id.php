<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRefID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('vats', function (Blueprint $table) {
      $table->integer('ref_id')->unsigned();
      });

      Schema::table('contracts', function (Blueprint $table) {
      $table->integer('ref_id')->unsigned();
      });
      
      Schema::table('item_promotions', function (Blueprint $table) {
      $table->integer('ref_id')->unsigned();
      });
      Schema::table('items', function (Blueprint $table) {
      $table->integer('ref_id')->unsigned();
      });
      Schema::table('relationships', function (Blueprint $table) {
      $table->integer('ref_id')->unsigned();
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
