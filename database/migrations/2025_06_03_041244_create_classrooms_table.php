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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id'); // Foreign key to centers table
            $table->string('day'); // Day of the class
            $table->time('start_time'); // Class start time
            $table->time('end_time'); // Class end time
            $table->foreignId('teacher_id'); // Foreign key to teachers table
            $table->integer('is_active'); // Status of the class
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
