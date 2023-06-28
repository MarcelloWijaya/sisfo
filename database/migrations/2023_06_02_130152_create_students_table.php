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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id');
            $table->foreignId('status_id');
            $table->string('nis');
            $table->string('name');
            $table->string('gender');
            $table->string('address');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('religion');
            $table->string('phone_number');
            $table->string('school_name');
            $table->string('parent_name');
            $table->date('entry_date');
            $table->date('registration_date');
            $table->string('level');
            $table->string('book_start');
            $table->string('parent_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
