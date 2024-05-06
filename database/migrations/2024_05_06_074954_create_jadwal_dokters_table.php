<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('jadwal_dokters', function (Blueprint $table) {
            $table->foreignId('id_dokter')->constrained('dokters')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_waktu')->constrained('waktus')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('jadwal_dokters');
    }
};