<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('reference')->nullable();
            $table->string('idno')->nullable();
            $table->string('employee')->nullable();
            $table->string('intime')->nullable();
            $table->string('outime')->nullable();
            $table->date('datefrom')->nullable();
            $table->date('dateto')->nullable();
            $table->integer('hours')->nullable();
            $table->string('restday')->nullable();
            $table->integer('archive')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}
