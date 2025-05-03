<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id'); // Foreign key to centers table
            $table->string('nis'); // Student Identification Number (NIS)
            $table->string('student_name'); // Student's Name
            $table->string('gender'); // Gender
            $table->string('address'); // Address
            $table->string('place_of_birth'); // Place of Birth
            $table->date('date_of_birth'); // Date of Birth
            $table->string('religion'); // Religion
            $table->string('phone_number'); // Phone Number
            $table->string('school_name'); // School Name
            $table->string('parent_name'); // Parent's Name
            $table->date('date_of_entry'); // Entry Date
            $table->date('registration_date'); // Registration Date
            $table->string('grade_level'); // Grade Level
            $table->string('book_start'); // Start of Book
            $table->string('parent_email'); // Parent's Email
            $table->timestamps(); // created_at, updated_at
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
