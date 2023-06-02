<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('branch_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id');
            $table->unsignedInteger('registration_fee');
            $table->unsignedInteger('equipment_fee');
            $table->unsignedInteger('course_fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('branch_payments');
    }
}
