<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('rawat_inaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('pasiens')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_dokter')->constrained('dokters')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('id_kamar')->constrained('kamars')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('rawat_inaps');
    }
};