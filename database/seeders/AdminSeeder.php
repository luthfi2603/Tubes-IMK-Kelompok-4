<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Admin::create([ // 1
            "nama" => "Muhammad Luthfi",
            "alamat" => "Jalan Makmur Gang Bakti No. 16B",
            "jenis_kelamin" => "L",
            "id_user" => "1",
        ]);
    }
}