<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_id')->nullable()->index();
            $table->foreign('customer_id')->references('id')->on('profiles');
            $table->boolean('customer_accepted')->default(false);

            $table->unsignedInteger('supplier_id')->nullable()->index();
            $table->foreign('supplier_id')->references('id')->on('profiles');
            $table->boolean('supplier_accepted')->default(false);

            //We can't assume customer will accept, so we can store default data here for supplier to use.
            $table->string('customer_alias')->nullable();
            $table->string('customer_taxid')->nullable();
            $table->string('customer_geoloc')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_telephone')->nullable();
            $table->string('customer_email')->nullable();

            //We can't assume supplier will accept, so we can store default data here for customer to use.
            $table->string('supplier_alias')->nullable();
            $table->string('supplier_taxid')->nullable();
            $table->string('supplier_geoloc')->nullable();
            $table->string('supplier_address')->nullable();
            $table->string('supplier_telephone')->nullable();
            $table->string('supplier_email')->nullable();

            $table->decimal('credit_limit')->nullable();
            $table->unsignedInteger('contract_ref')->nullable();
            

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
        Schema::dropIfExists('relationships');
    }
}
