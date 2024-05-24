<?php

namespace Database\Seeders;

use App\Models\Waktu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaktuSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Waktu::create([ // 1
            "hari" => fake()->randomElement($array = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu')),
            "jam" => "10:00-13:00",
        ]);
        Waktu::create([ // 2
            "hari" => fake()->randomElement($array = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu')),
            "jam" => "13:00-16:00",
        ]);
        Waktu::create([ // 3
            "hari" => fake()->randomElement($array = array('senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu')),
            "jam" => "08:00-12:00",
        ]);
    }
}