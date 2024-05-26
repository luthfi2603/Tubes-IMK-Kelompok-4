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
            // "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            'hari' => 'Senin',
            "jam" => "08:00-15:00",
        ]);
        Waktu::create([ // 2
            // "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            'hari' => 'Senin',
            "jam" => "10:00-16:00",
        ]);
        Waktu::create([ // 3
            // "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            'hari' => 'Senin',
            "jam" => "11:00-21:00",
        ]);
        Waktu::create([ // 4
            // "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            'hari' => 'Selasa',
            "jam" => "08:00-15:00",
        ]);
        Waktu::create([ // 5
            // "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            'hari' => 'Selasa',
            "jam" => "10:00-15:00",
        ]);
        Waktu::create([ // 6
            // "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            'hari' => 'Selasa',
            "jam" => "09:00-16:00",
        ]);
        Waktu::create([ // 7
            // "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            'hari' => 'Rabu',
            "jam" => "08:00-15:00",
        ]);
        Waktu::create([ // 8
            // "hari" => fake()->randomElement($array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')),
            'hari' => 'Rabu',
            "jam" => "10:00-14:00",
        ]);
        Waktu::create([ // 9
            'hari' => 'Kamis',
            "jam" => "08:00-15:00",
        ]);
        Waktu::create([ // 10
            'hari' => 'Kamis',
            "jam" => "10:00-16:00",
        ]);
        Waktu::create([ // 11
            'hari' => 'Kamis',
            "jam" => "11:00-21:00",
        ]);
        Waktu::create([ // 12
            'hari' => 'Jumat',
            "jam" => "08:00-15:00",
        ]);
        Waktu::create([ // 13
            'hari' => 'Jumat',
            "jam" => "10:00-16:00",
        ]);
        Waktu::create([ // 14
            'hari' => 'Jumat',
            "jam" => "11:00-21:00",
        ]);
        Waktu::create([ // 15
            'hari' => 'Sabtu',
            "jam" => "08:00-15:00",
        ]);
        Waktu::create([ // 16
            'hari' => 'Sabtu',
            "jam" => "10:00-16:00",
        ]);
        Waktu::create([ // 17
            'hari' => 'Sabtu',
            "jam" => "11:00-21:00",
        ]);
        Waktu::create([ // 18
            'hari' => 'Minggu',
            "jam" => "08:00-15:00",
        ]);
        Waktu::create([ // 19
            'hari' => 'Minggu',
            "jam" => "10:00-16:00",
        ]);
        Waktu::create([ // 20
            'hari' => 'Minggu',
            "jam" => "11:00-21:00",
        ]);
    }
}