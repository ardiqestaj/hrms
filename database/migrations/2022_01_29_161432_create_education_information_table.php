<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_information', function (Blueprint $table) {
            $table->id();
            $table->string('rec_id')->nullable();
            $table->string('institution')->nullable();
            $table->string('subject')->nullable();
            $table->string('st_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('degree')->nullable();
            $table->string('grade')->nullable();
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
        Schema::dropIfExists('education_information');
    }
}
