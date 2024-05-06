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
            "id_pasien" => "1",
            "id_dokter" => "1",
            "keluhan" => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            "diagnosa" => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            "therapie" => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
        ]);
    }
}