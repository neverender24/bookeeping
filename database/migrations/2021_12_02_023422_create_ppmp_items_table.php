<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpmpItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppmp_items', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ppmp')->nullable();
            $table->integer('id_supply')->nullable();
            $table->integer('stock_qty')->nullable();
            $table->integer('qty1')->nullable();
            $table->integer('qty2')->nullable();
            $table->integer('qty3')->nullable();
            $table->integer('qty4')->nullable();
            $table->integer('qty5')->nullable();
            $table->integer('qty6')->nullable();
            $table->integer('qty7')->nullable();
            $table->integer('qty8')->nullable();
            $table->integer('qty9')->nullable();
            $table->integer('qty10')->nullable();
            $table->integer('qty11')->nullable();
            $table->integer('qty12')->nullable();
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
        Schema::dropIfExists('ppmp_items');
    }
}
