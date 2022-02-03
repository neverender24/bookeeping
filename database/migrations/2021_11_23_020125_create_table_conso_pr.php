<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConsoPr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_conso_pr', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('fiscalyear')->length(4);
            $table->string('cprnumber', 15);
            $table->date('date_prepared');
            $table->double('pr_amount',12,2);
            $table->string('charges',200);
            $table->string('delivery_place', 30);
            $table->string('delivery_period', 30);
            $table->string('job_duration', 30);
            $table->string('remarks', 200);
            $table->string('requested_by', 40);
            $table->string('requested_pos', 40);
            $table->string('approved_by', 40);
            $table->string('approved_pos', 40);
            $table->date('date_cancelled');
            $table->integer('process_tag');
            $table->string('iduser',15);
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
        Schema::dropIfExists('table_conso_pr');
    }
}
