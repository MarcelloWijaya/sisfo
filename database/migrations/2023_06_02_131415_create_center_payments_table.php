<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('center_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id');
            $table->unsignedInteger('registration_fee_old')->nullable();
            $table->unsignedInteger('equipment_fee_old')->nullable();
            $table->unsignedInteger('course_fee_old')->nullable();
            $table->unsignedInteger('registration_fee_new')->nullable();
            $table->unsignedInteger('equipment_fee_new')->nullable();
            $table->unsignedInteger('course_fee_new')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('center_payments');
    }
};
