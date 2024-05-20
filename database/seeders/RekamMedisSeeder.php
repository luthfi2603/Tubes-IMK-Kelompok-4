<?php

namespace Database\Seeders;

use App\Models\RekamMedis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekamMedisSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        RekamMedis::create([ // 1
            "nama_pasien" => "Budi Kurniawan",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "alamat" => fake()->address(),
            "nomor_handphone" => "082162166387",
            "pekerjaan" => fake()->jobTitle(),
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('penyakit_dalam', 'estetika', 'obgyn')),
            "keluhan" => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            "diagnosa" => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            "therapie" => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
        ]);
    }
}