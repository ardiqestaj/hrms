<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
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
            $table->timestamps();
        });

        DB::table('payment_methods')->insert([
            [
                'payment_type' => "Fulltime",
                'salary_amount' => 5387.30,
                'hourly_salary' => null,
                'monthly_surcharge' => 200.00,
                'night_sunday_bon' => null,
                'holiday_bon' => null,
                'holiday_bon_minus' => null,
                'timesupplement_night_sunday' => null,
                'pension_insurance' => 5.3,
                'unemployment_insurance' => 1.1,
                'accident_insurance' => 1.945,
                'uvg_grb' => 0.014,
                'pension_fund' => 1.00,
                'medical_insurance' => 0.397,
                'collective_labor' => 1.00,
                'expenses' => 22.50,
                'telephone_shipment' => 10.00,
                'mileage_compensation' => 80.00],
        ]);

        DB::table('payment_methods')->insert([
            [
                'payment_type' => "Parttime",
                'salary_amount' => 3387.30,
                'hourly_salary' => null,
                'monthly_surcharge' => 200.00,
                'night_sunday_bon' => null,
                'holiday_bon' => null,
                'holiday_bon_minus' => null,
                'timesupplement_night_sunday' => null,
                'pension_insurance' => 5.3,
                'unemployment_insurance' => 1.1,
                'accident_insurance' => 1.945,
                'uvg_grb' => 0.014,
                'pension_fund' => 1.00,
                'medical_insurance' => 0.397,
                'collective_labor' => 1.00,
                'expenses' => 22.50,
                'telephone_shipment' => 10.00,
                'mileage_compensation' => 80.00],
        ]);

        DB::table('payment_methods')->insert([
            [
                'payment_type' => "Hourly",
                'salary_amount' => null,
                'hourly_salary' => 22.85,
                'monthly_surcharge' => null,
                'night_sunday_bon' => 22.85,
                'holiday_bon' => 8.33,
                'holiday_bon_minus' => 8.33,
                'timesupplement_night_sunday' => 22.85,
                'pension_insurance' => 5.3,
                'unemployment_insurance' => 1.1,
                'accident_insurance' => 1.945,
                'uvg_grb' => 0.014,
                'pension_fund' => null,
                'medical_insurance' => 0.397,
                'collective_labor' => 1.00,
                'expenses' => null,
                'telephone_shipment' => 10.00,
                'mileage_compensation' => null],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
