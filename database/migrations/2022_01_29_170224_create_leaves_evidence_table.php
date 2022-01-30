<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves_evidence', function (Blueprint $table) {
            $table->id('leaves_evidence_id');
            $table->string('leave_applies_id')->nullable();
            $table->string('leave_type_id')->nullable();
            $table->string('rec_id')->nullable();
            $table->string('day')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('leaves_evidence');
    }
}
