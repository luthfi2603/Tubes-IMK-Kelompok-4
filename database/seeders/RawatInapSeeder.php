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
            "nama_pasien" => "Budi Kurniawan",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "alamat" => fake()->address(),
            "nomor_handphone" => "082162166387",
            "diagnosa" => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('penyakit_dalam', 'estetika', 'obgyn')),
            "id_kamar" => "1",
        ]);
    }
}