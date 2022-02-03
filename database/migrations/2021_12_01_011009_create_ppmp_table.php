<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppmp', function (Blueprint $table) {
            $table->id();
            $table->integer('fiscalyear')->nullable();
            $table->string('ppmp_type', 15)->nullable();
            $table->string('ppmp_desc', 200)->nullable();
            $table->string('ffunccod', 7)->nullable();
            $table->integer('idraao')->nullable();
            $table->integer('idooe')->nullable();
            $table->string('fund_type', 30)->nullable();
            $table->string('fund_desc', 200)->nullable();
            $table->double('planned_amt', 12, 2)->nullable();
            $table->date('date_posted')->nullable();
            $table->string('qtr_posted', 40)->nullable();
            $table->string('prepared_by', 40)->nullable();
            $table->string('prepared_pos', 40)->nullable();
            $table->string('recapp_by', 40)->nullable();
            $table->string('recapp_pos', 40)->nullable();
            $table->string('approved_by', 40)->nullable();
            $table->string('approved_pos', 40)->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('ppmp');
    }
}
