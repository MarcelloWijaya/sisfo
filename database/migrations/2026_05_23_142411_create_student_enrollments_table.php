<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->string('program_name'); // Nama program: "Math Monthly", dll
            $table->enum('billing_cycle', ['monthly', '3-month', '6-month', '12-month'])->default('monthly');
            $table->decimal('fee_amount', 12, 2); // Biaya per cycle
            $table->date('start_date');
            $table->date('end_date')->nullable(); // null = ongoing
            $table->date('next_invoice_date'); // Kapan invoice berikutnya digenerate
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['branch_id', 'status']);
            $table->index(['next_invoice_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_enrollments');
    }
};
