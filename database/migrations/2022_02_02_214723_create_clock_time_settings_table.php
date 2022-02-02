<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClockTimeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clock_time_settings', function (Blueprint $table) {
            $table->id();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->string('clock_comment')->nullable();
            $table->string('rfid')->nullable();
            $table->integer('time_format')->nullable();
            $table->string('iprestriction')->nullable();
            $table->string('opt')->nullable();
            $table->timestamps();
        });
        DB::table('clock_time_settings')->insert([
            ['id' => 1,
             'country' => 'United States of America',
             'timezone' => 'America/New_York', 
             'clock_comment' => NULL, 
             'rfid' => NULL, 
             'time_format' => 1, 
             'iprestriction' => NULL, 
             'opt'=> '']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clock_time_settings');
    }
}
