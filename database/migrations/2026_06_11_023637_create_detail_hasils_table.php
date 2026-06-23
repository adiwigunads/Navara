<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_hasil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_id')->constrained('hasil_perhitungan')->cascadeOnDelete();
            $table->foreignId('alternatif_id')->constrained('alternatif')->cascadeOnDelete();
            $table->decimal('yi', 12, 8);
            $table->unsignedInteger('ranking');
            $table->unique(['hasil_id', 'alternatif_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_hasil');
    }
};
