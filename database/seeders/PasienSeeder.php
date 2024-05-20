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
            "nama" => 'Budi Kurniawan',
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "4",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
        Pasien::create([ // 2
            "nama" => 'Henky Kurniawan',
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "5",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
        Pasien::create([ // 3
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "6",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
        Pasien::create([ // 4
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "7",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
        Pasien::create([ // 5
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "8",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
        Pasien::create([ // 6
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "9",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
        Pasien::create([ // 7
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "10",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "pekerjaan" => fake()->jobTitle(),
        ]);
    }
}