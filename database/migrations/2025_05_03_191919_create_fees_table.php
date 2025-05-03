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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id'); // id_cabang
            $table->string('academic_year', 9); // tahun_ajaran
            $table->enum('payment_type', ['Monthly', 'Quarterly', 'Semester', 'Yearly']); // tipe_pembayaran
            $table->integer('registration_fee'); // pendaftaran
            $table->integer('equipment_fee'); // peralatan
            $table->integer('course_fee'); // uang_kursus
            $table->string('note')->nullable(); // keterangan
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
