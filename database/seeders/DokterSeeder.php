<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DokterSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Dokter::create([ // 1
            "nama" => 'Clinton Christovel',
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "2",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
        Dokter::create([ // 2
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "11",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
        Dokter::create([ // 3
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "12",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
        Dokter::create([ // 4
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "13",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
        Dokter::create([ // 5
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "14",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
        Dokter::create([ // 6
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "15",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
        Dokter::create([ // 7
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "16",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
        Dokter::create([ // 8
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "17",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
        Dokter::create([ // 9
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "18",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
        ]);
    }
}