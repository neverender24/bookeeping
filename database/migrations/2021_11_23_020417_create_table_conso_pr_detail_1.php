<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConsoPrDetail1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_conso_pr_detail_1', function (Blueprint $table) {
            $table->id();
            $table->string('cprnumber',15);
            $table->string('ind_prno',15);
            $table->double('amout',12,2);
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
        Schema::dropIfExists('table_conso_pr_detail_1');
    }
}
