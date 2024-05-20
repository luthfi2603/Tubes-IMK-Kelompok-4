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
            "spesialis" => fake()->randomElement($array = array('penyakit_dalam', 'estetika', 'obgyn')),
        ]);
    }
}