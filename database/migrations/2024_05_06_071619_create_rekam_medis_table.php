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
            $table->string('nama_pasien');
            $table->unsignedTinyInteger('umur');
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->string('pekerjaan');
            $table->string('alamat');
            $table->char('nomor_handphone', 15);
            $table->string('nama_dokter');
            $table->enum('spesialis', ['Penyakit Dalam', 'Estetika', 'Obgyn']);
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->text('therapie');
            $table->string('foto')->nullable();
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