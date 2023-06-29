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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id');
            $table->string('name');
            $table->string('nickname');
            $table->string('gender');
            $table->string('address');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('religion');
            $table->string('phone_number');
            $table->string('last_education');
            $table->string('email')->nullable();
            $table->date('training_date');
            $table->foreignId('status_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
