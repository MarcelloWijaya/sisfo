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
            | Branch Relation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | User Account Relation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Student Personal Information
            |--------------------------------------------------------------------------
            */

            $table->string('student_code')->unique(); // Kode unik siswa (STD-JKT-001)
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->text('address')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('phone')->nullable();
            $table->string('school_name')->nullable();
            $table->string('class')->nullable(); // kelas / grade level

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
            | Academic Information
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
            | Audit Trail
            |--------------------------------------------------------------------------
            */

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes for Performance
            |--------------------------------------------------------------------------
            */

            $table->index(['branch_id', 'status']);
            $table->index('student_code');
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
