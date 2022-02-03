<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestDaetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request_daetails', function (Blueprint $table) {
            $table->id();
            $table->string('prnumber', 15);
            $table->unsignedInteger('id_supply');
            $table->unsignedInteger('itemno');
            $table->string('unit',20);
            $table->string('description',250);
            $table->longText('addtl_specs');
            $table->double('unitcost',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_request_daetails');
    }
}
