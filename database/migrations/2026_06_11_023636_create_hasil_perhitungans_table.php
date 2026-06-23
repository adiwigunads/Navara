<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_perhitungan', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->useCurrent();
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_perhitungan');
    }
};
