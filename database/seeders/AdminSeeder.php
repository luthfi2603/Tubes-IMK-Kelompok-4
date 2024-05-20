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
            "nama" => fake()->name(),
            "alamat" => fake()->address(),
            "jenis_kelamin" => fake()->randomElement($array = array('P', 'L')),
            "id_user" => "1",
        ]);
    }
}