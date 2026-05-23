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
            | Teacher Information
            |--------------------------------------------------------------------------
            */

            $table->string('teacher_number')->unique();

            $table->string('name');

            $table->string('nickname')->nullable();

            $table->enum('gender', ['male', 'female'])->nullable();

            $table->text('address')->nullable();

            $table->string('place_of_birth')->nullable();

            $table->date('date_of_birth')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Education & Employment
            |--------------------------------------------------------------------------
            */

            $table->string('last_education')->nullable();

            $table->date('join_date')->nullable();

            $table->decimal('salary', 15, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->enum('status', ['active', 'inactive', 'resigned'])->default('active');

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
        Schema::dropIfExists('teachers');
    }
};
