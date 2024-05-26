<?php

namespace Database\Seeders;

use App\Models\JadwalDokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalDokterSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        JadwalDokter::create([ // 1
            "id_dokter" => "1",
            "id_waktu" => "1",
        ]);
        JadwalDokter::create([ // 2
            "id_dokter" => "1",
            "id_waktu" => "4",
        ]);
        JadwalDokter::create([ // 3
            "id_dokter" => "1",
            "id_waktu" => "8",
        ]);
        JadwalDokter::create([ // 4
            "id_dokter" => "1",
            "id_waktu" => "10",
        ]);
        JadwalDokter::create([ // 5
            "id_dokter" => "1",
            "id_waktu" => "14",
        ]);
        JadwalDokter::create([ // 6
            "id_dokter" => "1",
            "id_waktu" => "16",
        ]);
        JadwalDokter::create([ // 7
            "id_dokter" => "1",
            "id_waktu" => "20",
        ]);
        JadwalDokter::create([ // 8
            "id_dokter" => "2",
            "id_waktu" => "20",
        ]);
        JadwalDokter::create([ // 9
            "id_dokter" => "2",
            "id_waktu" => "14",
        ]);
        JadwalDokter::create([ // 10
            "id_dokter" => "3",
            "id_waktu" => "1",
        ]);
        JadwalDokter::create([ // 11
            "id_dokter" => "3",
            "id_waktu" => "15",
        ]);
        JadwalDokter::create([ // 12
            "id_dokter" => "3",
            "id_waktu" => "18",
        ]);
        JadwalDokter::create([ // 13
            "id_dokter" => "4",
            "id_waktu" => "4",
        ]);
        JadwalDokter::create([ // 14
            "id_dokter" => "4",
            "id_waktu" => "10",
        ]);
        JadwalDokter::create([ // 15
            "id_dokter" => "5",
            "id_waktu" => "18",
        ]);
        JadwalDokter::create([ // 16
            "id_dokter" => "5",
            "id_waktu" => "4",
        ]);
        JadwalDokter::create([ // 17
            "id_dokter" => "5",
            "id_waktu" => "10",
        ]);
        JadwalDokter::create([ // 18
            "id_dokter" => "6",
            "id_waktu" => "10",
        ]);
        JadwalDokter::create([ // 19
            "id_dokter" => "7",
            "id_waktu" => "12",
        ]);
        JadwalDokter::create([ // 20
            "id_dokter" => "8",
            "id_waktu" => "3",
        ]);
        JadwalDokter::create([ // 21
            "id_dokter" => "9",
            "id_waktu" => "9",
        ]);
    }
}