<?php

namespace Database\Seeders;

use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservasiSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Reservasi::create([ // 1
            "nama_pasien" => "Budi Kurniawan",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "alamat" => fake()->address(),
            "nomor_handphone" => "082162166387",
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('penyakit_dalam', 'estetika', 'obgyn')),
            "status" => "selesai",
        ]);
        Reservasi::create([ // 2
            "nama_pasien" => "Henky Kurniawan",
            "tanggal_lahir" => fake()->date($format = 'Y-m-d', $max = 'now'),
            "alamat" => fake()->address(),
            "nomor_handphone" => "08983847304",
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('penyakit_dalam', 'estetika', 'obgyn')),
            "status" => "menunggu",
        ]);
    }
}