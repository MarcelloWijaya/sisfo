<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 30)->unique(); // INV-BRN01-230526143022
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('enrollment_id')->constrained('student_enrollments')->onDelete('cascade');
            $table->string('program_name');
            $table->decimal('amount', 12, 2);
            $table->date('billing_period_start');
            $table->date('billing_period_end');
            $table->date('due_date');
            $table->enum('status', ['unpaid', 'pending', 'paid', 'overdue', 'cancelled'])->default('unpaid');
            $table->text('notes')->nullable();
            $table->boolean('reminded_7d')->default(false);
            $table->boolean('reminded_due')->default(false);
            $table->integer('reminded_overdue')->default(0);
            $table->timestamp('generated_at')->useCurrent();
            $table->timestamps();

            $table->index(['branch_id', 'status']);
            $table->index(['student_id', 'status']);
            $table->index(['due_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
