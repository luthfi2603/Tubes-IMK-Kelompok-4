<?php

namespace Database\Seeders;

use App\Models\RawatInap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RawatInapSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        RawatInap::create([ // 1
            "id_dokter" => "1",
            "id_pasien" => "2",
            "id_kamar" => "1",
        ]);
    }
}