<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('rec_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('salary_amount')->nullable();
            $table->string('hourly_salary')->nullable();
            $table->string('monthly_surcharge')->nullable();
            $table->string('night_sunday_bon')->nullable();
            $table->string('holiday_bon')->nullable();
            $table->string('holiday_bon_minus')->nullable();
            $table->string('timesupplement_night_sunday')->nullable();
            $table->string('pension_insurance')->nullable();
            $table->string('unemployment_insurance')->nullable();
            $table->string('accident_insurance')->nullable();
            $table->string('uvg_grb')->nullable();
            $table->string('pension_fund')->nullable();
            $table->string('medical_insurance')->nullable();
            $table->string('collective_labor')->nullable();
            $table->string('expenses')->nullable();
            $table->string('telephone_shipment')->nullable();
            $table->string('mileage_compensation')->nullable();
            // $table->string('salary')->nullable();
            // $table->string('basic')->nullable();
            // $table->string('da')->nullable();
            // $table->string('hra')->nullable();
            // $table->string('conveyance')->nullable();
            // $table->string('allowance')->nullable();
            // $table->string('medical_allowance')->nullable();
            // $table->string('tds')->nullable();
            // $table->string('esi')->nullable();
            // $table->string('pf')->nullable();
            // $table->string('leave')->nullable();
            // $table->string('prof_tax')->nullable();
            // $table->string('labour_welfare')->nullable();
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
        Schema::dropIfExists('staff_salaries');
    }
}
