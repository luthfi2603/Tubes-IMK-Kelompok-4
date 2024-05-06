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
    }
}