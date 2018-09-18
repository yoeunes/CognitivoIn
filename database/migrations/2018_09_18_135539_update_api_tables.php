$table->int('lead_time')->unsigned();<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateApiTables extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('relationships', function (Blueprint $table) {
            $table->unsignedInt('lead_time');
            $table->dropColumn('ref_id');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->string('barcode')->after(sku);
            $table->unsignedDecimal('weight', 18, 2)->nullable();
            $table->unsignedDecimal('volume', 18, 2)->nullable();
            $table->boolean('use_scale')->default(false);
            $table->dropColumn('ref_id');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('relationships', function (Blueprint $table)
        {
            $table->int('ref_id')->unsigned();
            $table->dropColumn('lead_time');
        });

        Schema::table('relationships', function (Blueprint $table)
        {
            $table->int('ref_id')->unsigned();
            $table->dropColumn('barcode');
        });
    }
}
