<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade'); // GANTI schedule_id → classroom_id
            $table->date('attendance_date');
            $table->enum('status', ['present', 'absent', 'late', 'excused'])->default('present');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            // Index untuk performance
            $table->index(['branch_id', 'attendance_date']);
            $table->index(['student_id', 'attendance_date']);
            $table->index(['classroom_id', 'attendance_date']);
            $table->unique(['student_id', 'classroom_id', 'attendance_date'], 'unique_student_attendance');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
