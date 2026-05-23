<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->date('attendance_date');
            $table->enum('status', ['present', 'absent', 'late', 'excused', 'sick', 'leave'])->default('present');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            // Index
            $table->index(['branch_id', 'attendance_date']);
            $table->index(['teacher_id', 'attendance_date']);
            $table->unique(['teacher_id', 'attendance_date'], 'unique_teacher_attendance');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_attendances');
    }
};
