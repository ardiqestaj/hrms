<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id('leave_id');
            $table->string('leave_names')->nullable();
            $table->string('leave_days')->nullable();
            $table->timestamps();
        });
        DB::table('leave_types')->insert([
            ['leave_names' => 'Annual Leave', 'leave_days' => '14'],
            ['leave_names' => 'Medical Leave', 'leave_days' => '7'],
            
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
}
