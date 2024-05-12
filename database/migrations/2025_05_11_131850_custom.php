<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        DROP VIEW IF EXISTS data_pasien;
        CREATE VIEW data_pasien AS SELECT 
        a.nama, a.alamat, b.nomor_handphone
        FROM pasiens a
        JOIN users b ON
        a.id = b.id;
        ');
    }

};
