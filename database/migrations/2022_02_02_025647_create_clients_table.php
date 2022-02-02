<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('rec_client_id');
            $table->string('client_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_mobile_phone')->nullable();
            $table->string('client_fax_phone')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
