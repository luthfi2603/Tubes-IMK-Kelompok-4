<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasien');
            $table->unsignedTinyInteger('umur');
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->string('alamat');
            $table->char('nomor_handphone', 15);
            $table->string('nama_dokter');
            $table->enum('spesialis', ['Estetika', 'Obgyn', 'Penyakit Dalam']);
            $table->enum('status', ['Selesai', 'Menunggu', 'Batal']);
            $table->date('tanggal');
            $table->char('jam', 11);
            $table->unsignedBigInteger('id_rekam_medis')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('reservasis');
    }
};