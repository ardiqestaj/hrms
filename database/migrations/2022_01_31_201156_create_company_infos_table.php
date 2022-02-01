<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_contact')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_country')->nullable()->default('N/A');
            $table->string('company_city')->nullable();
            $table->string('company_province')->nullable();
            $table->string('company_postal_code')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone_number')->nullable();
            $table->string('company_mobile_number')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_website')->nullable();
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
        Schema::dropIfExists('company_infos');
    }
}
