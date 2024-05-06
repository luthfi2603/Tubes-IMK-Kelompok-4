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
    }
}