<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PasienSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Pasien::create([ // 1
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "4",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
        Pasien::create([ // 2
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "5",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
    }
}