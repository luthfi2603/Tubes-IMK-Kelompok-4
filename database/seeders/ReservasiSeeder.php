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
            "id_pasien" => "1",
            "id_dokter" => "1",
            "status" => "menunggu",
        ]);
        Reservasi::create([ // 2
            "id_pasien" => "2",
            "id_dokter" => "1",
            "status" => "menunggu",
        ]);
    }
}