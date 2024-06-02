<?php

namespace Database\Seeders;

use App\Models\Perawat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerawatSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Perawat::create([ // 1
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "3",
        ]);
        Perawat::create([ // 2
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "19",
        ]);
        Perawat::create([ // 3
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "20",
        ]);
        Perawat::create([ // 4
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "21",
        ]);
        Perawat::create([ // 5
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "22",
        ]);
        Perawat::create([ // 6
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "23",
        ]);
    }
}