<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code', 30)->unique(); // AUTO: CPN-BRN01-230526143022
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->string('student_name');
            $table->string('program_name');
            $table->decimal('amount_paid', 12, 2);
            $table->date('payment_date');
            $table->string('billing_period'); // "Mei 2025 - Mei 2025"
            $table->boolean('is_used')->default(true); // selalu true saat dibuat
            $table->timestamp('issued_at')->useCurrent();
            $table->timestamps();

            $table->index(['branch_id', 'issued_at']);
            $table->index(['student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
