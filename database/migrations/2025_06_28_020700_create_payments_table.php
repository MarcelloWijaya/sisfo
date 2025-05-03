<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // equivalent to id_bayar
            $table->string('email');
            $table->foreignId('student_id'); // id_siswa
            $table->date('payment_date'); // tgl_bayar
            $table->string('payment_month', 10); // bln_bayar
            $table->string('payment_year', 4); // thn_bayar
            $table->foreignId('fee_id'); // id_biaya
            $table->string('status', 10); // status
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
