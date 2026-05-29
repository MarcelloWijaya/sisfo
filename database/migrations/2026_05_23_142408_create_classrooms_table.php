<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->string('day'); // Senin, Selasa, Rabu, dll
            $table->time('start_time'); // 10:00:00
            $table->time('end_time'); // 11:00:00
            $table->string('room'); // Ruangan A-101, B-202
            $table->string('level'); // Level/Paket: Beginner, Intermediate, Advanced
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->string('activity'); // Aktivitas: English Class, Math Tutoring, dll
            $table->integer('quota')->default(20); // Kuota siswa
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Index untuk performance
            $table->index(['branch_id', 'day', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
