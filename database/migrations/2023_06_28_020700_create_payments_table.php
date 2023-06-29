<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id');
            $table->foreignId('student_id');
            $table->timestamp('payment_date')->nullable();
            $table->integer('discount')->nullable();
            $table->string('coupun_number')->nullable();
            $table->foreignId('payment_type_id');
            $table->foreignId('payment_status_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
