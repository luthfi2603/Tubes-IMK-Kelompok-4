<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu')->useCurrent();
            $table->foreignId('id_pasien')->constrained('pasiens')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_dokter')->constrained('dokters')->onDelete('restrict')->onUpdate('cascade');
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->text('therapie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('rekam_medis');
    }
};