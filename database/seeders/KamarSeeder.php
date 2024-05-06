<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Kamar::create([ // 1
            "status" => fake()->randomElement($array = array('tersedia', 'terpakai')),
        ]);
    }
}