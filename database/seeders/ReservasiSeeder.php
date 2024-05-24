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
            "umur" => 20,
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "alamat" => fake()->address(),
            "nomor_handphone" => "082162166387",
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('penyakit_dalam', 'estetika', 'obgyn')),
            "status" => "selesai",
            "waktu" => Carbon::now(),
        ]);
        Reservasi::create([ // 2
            "nama_pasien" => "Henky Kurniawan",
            "umur" => 20,
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "alamat" => fake()->address(),
            "nomor_handphone" => "08983847304",
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('penyakit_dalam', 'estetika', 'obgyn')),
            "status" => "menunggu",
            "waktu" => Carbon::now(),
        ]);
        Reservasi::create([ // 3
            "nama_pasien" => "Susanti Kiranti",
            "umur" => 27,
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "alamat" => fake()->address(),
            "nomor_handphone" => "08983847305",
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('penyakit_dalam', 'estetika', 'obgyn')),
            "status" => "batal",
            "waktu" => Carbon::now(),
        ]);
    }
}