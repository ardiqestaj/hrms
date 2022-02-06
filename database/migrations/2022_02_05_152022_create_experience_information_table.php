<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_information', function (Blueprint $table) {
            $table->id('exp_id');
            $table->string('rec_id');
            $table->string('work_company_name');
            $table->string('work_address');
            $table->string('work_position');
            $table->string('work_period_from');
            $table->string('work_period_to');
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
        Schema::dropIfExists('experience_information');
    }
}
