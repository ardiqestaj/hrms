<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('role_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('department')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('monday')->nullable();
            $table->string('tuesday')->nullable();
            $table->string('wednesday')->nullable();
            $table->string('thursday')->nullable();
            $table->string('friday')->nullable();
            $table->string('saturday')->nullable();
            $table->string('sunday')->nullable();
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('monday_opt')->nullable();
            $table->string('tuesday_opt')->nullable();
            $table->string('wednesday_opt')->nullable();
            $table->string('thursday_opt')->nullable();
            $table->string('friday_opt')->nullable();
            $table->string('saturday_opt')->nullable();
            $table->string('sunday_opt')->nullable();
            $table->string('time_start_opt')->nullable();
            $table->string('time_end_opt')->nullable();
            $table->string('company')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
