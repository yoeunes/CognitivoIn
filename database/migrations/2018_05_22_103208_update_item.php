<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateItem extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::table('items', function (Blueprint $table)
    {
      $table->boolean('is_stockable')->default(false);
    });


  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::table('items', function (Blueprint $table)
    {


      $table->dropColumn(['is_stockable']);

    });


  }
}
