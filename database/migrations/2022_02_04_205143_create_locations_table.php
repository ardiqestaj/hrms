<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('rec_client_id');
            $table->string('location_name');
            $table->string('location_address');
            $table->string('location_email');
            $table->string('location_phone_number');
            // $table->string('location_nr_of_employee_type1');
            // $table->string('location_nr_of_employee_type2');
            // $table->string('location_nr_of_employee_type3');
            // $table->string('location_type_of_work1');
            // $table->string('location_type_of_work2');
            // $table->string('location_type_of_work3');
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
        Schema::dropIfExists('locations');
    }
}
