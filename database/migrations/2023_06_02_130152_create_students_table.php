<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id');
            $table->string('nama_siswa');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('nomer_telp');
            $table->string('nama_sekolah');
            $table->string('nama_orangtua');
            $table->date('tanggal_masuk');
            $table->date('tanggal_daftar');
            $table->string('tingkatan');
            $table->string('start_buku');
            $table->string('email_orangtua');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
