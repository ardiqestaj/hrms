<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_clocks', function (Blueprint $table) {
            $table->id();
            $table->integer('reference')->nullable();
            $table->string('idno');
            $table->date('date')->nullable();
            $table->string('employee');
            $table->string('timein')->nullable();
            $table->string('timeout')->nullable();
            $table->string('totalhours');
            $table->string('status_timein');
            $table->string('status_timeout');
            $table->string('reason');
            $table->string('comment');
            $table->timestamps();
        });
        DB::table('time_clocks')->insert([
            [
             'reference' => NULL,
             'idno' => '', 
             'date' => NULL, 
             'employee' => '', 
             'timein' => NULL, 
             'timeout' => NULL, 
             'totalhours' => '', 
             'status_timein' => '', 
             'status_timeout' => '', 
             'reason' => '', 
             'comment' =>  '']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_clocks');
    }
}
