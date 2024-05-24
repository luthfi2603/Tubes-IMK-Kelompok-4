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
                b.nomor_handphone,
                b.aktif
            FROM pasiens a
            INNER JOIN users b ON a.id_user = b.id;
        ');

        DB::unprepared('
            DROP VIEW IF EXISTS data_karyawan;
            CREATE VIEW data_karyawan AS
            SELECT
                b.nama, 
                b.alamat,
                a.nomor_handphone,
                a.status
            FROM users a
            INNER JOIN dokters b ON a.id = b.id_user 
            UNION
            SELECT
                c.nama, 
                c.alamat,
                a.nomor_handphone,
                a.status
            FROM users a
            INNER JOIN perawats c ON a.id = c.id_user 
            UNION
            SELECT
                d.nama, 
                d.alamat,
                a.nomor_handphone,
                a.status
            FROM users a
            INNER JOIN admins d ON a.id = d.id_user 
        ');
        
        DB::unprepared('
            DROP VIEW IF EXISTS view_jadwal_dokter;
            CREATE VIEW view_jadwal_dokter AS
            SELECT
                a.id AS id_dokter,
                a.nama,
                a.spesialis,
                c.hari,
                c.jam
            FROM dokters a
            INNER JOIN jadwal_dokters b ON a.id = b.id_dokter
            INNER JOIN waktus c ON c.id = b.id_waktu
        ');
    }
};