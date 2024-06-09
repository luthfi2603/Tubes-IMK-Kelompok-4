<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Reservasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
            "status" => "Selesai",
            "tanggal" => '2024-05-25',
            "jam" => '10:00-13:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Reservasi::create([ // 2
            "nama_pasien" => "Henky Kurniawan",
            "umur" => 20,
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "alamat" => fake()->address(),
            "nomor_handphone" => "08983847304",
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
            "status" => "Menunggu",
            "tanggal" => '2024-05-27',
            "jam" => '08:00-11:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Reservasi::create([ // 3
            "nama_pasien" => "Susanti Kiranti",
            "umur" => 27,
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "alamat" => fake()->address(),
            "nomor_handphone" => "08983847305",
            "nama_dokter" => "Clinton Christovel",
            "spesialis" => fake()->randomElement($array = array('Penyakit Dalam', 'Estetika', 'Obgyn')),
            "status" => "Batal",
            "tanggal" => '2024-05-28',
            "jam" => '15:00-17:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}