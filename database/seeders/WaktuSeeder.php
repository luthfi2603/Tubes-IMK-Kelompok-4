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
            "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            "jam" => "10:00-13:00",
        ]);
        Waktu::create([ // 2
            "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            "jam" => "13:00-16:00",
        ]);
        Waktu::create([ // 3
            "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            "jam" => "08:00-12:00",
        ]);
        Waktu::create([ // 4
            "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            "jam" => "08:00-12:00",
        ]);
        Waktu::create([ // 5
            "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            "jam" => "08:00-12:00",
        ]);
        Waktu::create([ // 6
            "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            "jam" => "08:00-12:00",
        ]);
        Waktu::create([ // 7
            "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            "jam" => "08:00-12:00",
        ]);
        Waktu::create([ // 8
            "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            "jam" => "08:00-12:00",
        ]);
    }
}