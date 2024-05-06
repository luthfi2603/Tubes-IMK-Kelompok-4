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
    }
}