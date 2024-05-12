<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        DB::unprepared('
            DROP VIEW IF EXISTS data_pasien;
            CREATE VIEW data_pasien AS
            SELECT
                a.nama,
                a.alamat,
                b.nomor_handphone
            FROM pasiens a
            INNER JOIN users b ON a.id = b.id;
        ');
    }
};