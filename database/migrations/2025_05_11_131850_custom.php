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
            INNER JOIN admins d ON a.id = d.id_user;

            DROP VIEW IF EXISTS view_jadwal_dokter;
            CREATE VIEW view_jadwal_dokter AS
            SELECT
                a.id AS id_dokter,
                d.foto,
                a.nama,
                a.spesialis,
                c.hari,
                c.jam
            FROM dokters a
            INNER JOIN jadwal_dokters b ON a.id = b.id_dokter
            INNER JOIN waktus c ON c.id = b.id_waktu
            INNER JOIN users d ON d.id = a.id_user;
            
            DROP VIEW IF EXISTS view_data_perawat;
            CREATE VIEW view_data_perawat AS
            SELECT
                a.id AS \'id_user\',
                b.id AS \'id_perawat\',
                b.nama,
                a.nomor_handphone,
                b.jenis_kelamin,
                b.alamat,
                a.foto
            FROM users a
            INNER JOIN perawats b ON b.id_user = a.id
            ORDER BY b.nama;

            SET GLOBAL event_scheduler = ON;
            DROP EVENT IF EXISTS event_ubah_status_reservasi;
            DELIMITER //
            CREATE EVENT event_ubah_status_reservasi
            ON SCHEDULE EVERY 1 DAY
            STARTS CURRENT_DATE + INTERVAL 1 DAY
            DO
            BEGIN
                UPDATE reservasis
                SET status = "Batal"
                WHERE tanggal < CURDATE() AND status = "Menunggu";
            END //
            DELIMITER ;
        ');
    }
};