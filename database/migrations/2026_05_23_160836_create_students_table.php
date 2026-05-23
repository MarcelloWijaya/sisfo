<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Branch
            |--------------------------------------------------------------------------
            */

            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | User Account
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Student Information
            |--------------------------------------------------------------------------
            */

            $table->string('student_number')->unique();

            $table->string('name');

            $table->enum('gender', ['male', 'female']);

            $table->text('address')->nullable();

            $table->string('place_of_birth')->nullable();

            $table->date('date_of_birth')->nullable();

            $table->string('religion')->nullable();

            $table->string('phone')->nullable();

            $table->string('school_name')->nullable();

            $table->string('grade_level')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Parent Information
            |--------------------------------------------------------------------------
            */

            $table->string('parent_name')->nullable();

            $table->string('parent_phone')->nullable();

            $table->string('parent_email')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Academic
            |--------------------------------------------------------------------------
            */

            $table->date('registration_date')->nullable();

            $table->date('join_date')->nullable();

            $table->string('book_level')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', ['active', 'inactive', 'graduated', 'suspended'])->default('active');

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
