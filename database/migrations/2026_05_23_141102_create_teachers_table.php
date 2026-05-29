<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Branch & User Relation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Teacher Personal Information
            |--------------------------------------------------------------------------
            */

            $table->string('teacher_code')->unique(); // Kode unik guru (TCH-JKT-001)
            $table->string('name'); // Nama lengkap guru
            $table->string('nickname')->nullable(); // Nama panggilan
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->text('address')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->unique();

            /*
            |--------------------------------------------------------------------------
            | Education & Qualification
            |--------------------------------------------------------------------------
            */

            $table->string('last_education')->nullable(); // Pendidikan terakhir
            $table->string('qualification')->nullable(); // Kualifikasi/Sertifikasi

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', ['active', 'inactive'])->default('active');

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
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index(['branch_id', 'status']);
            $table->index('teacher_code');
            $table->index('name');
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
