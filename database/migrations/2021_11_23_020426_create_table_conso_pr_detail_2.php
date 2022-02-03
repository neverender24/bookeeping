<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConsoPrDetail2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_conso_pr_detail_2', function (Blueprint $table) {
            $table->id();
            $table->string('cprnumber',15);
            $table->integer('id_supply');
            $table->integer('itemno');
            $table->string('unit', 20);
            $table->string('description',250);
            $table->longText('addtl_specs');
            $table->double('unitcost');
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
        Schema::dropIfExists('table_conso_pr_detail_2');
    }
}
