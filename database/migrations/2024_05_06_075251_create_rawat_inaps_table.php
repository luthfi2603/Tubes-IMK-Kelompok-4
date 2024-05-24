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
            $table->string('nama_pasien');
            $table->unsignedTinyInteger('umur');
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->string('alamat');
            $table->char('nomor_handphone', 15);
            $table->text('diagnosa');
            $table->string('nama_dokter');
            $table->enum('spesialis', ['penyakit_dalam', 'estetika', 'obgyn']);
            $table->foreignId('id_kamar')->constrained('kamars')->onDelete('restrict')->onUpdate('cascade');
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