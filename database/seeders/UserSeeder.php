<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::create([ // 1
            'nomor_handphone' => '08983847300',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'admin',
        ]);
        User::create([ // 2
            'nomor_handphone' => '08983847301',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'dokter',
        ]);
        User::create([ // 3
            'nomor_handphone' => '08983847302',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'perawat',
        ]);
        User::create([ // 4
            'nomor_handphone' => '082162166387',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('password'),
            'status' => 'pasien',
        ]);
        User::create([ // 5
            'nomor_handphone' => '08983847304',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'pasien',
        ]);
        User::create([ // 6
            'nomor_handphone' => '08983847305',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'pasien',
        ]);
        User::create([ // 7
            'nomor_handphone' => '08983847306',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'pasien',
        ]);
        User::create([ // 8
            'nomor_handphone' => '08983847307',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'pasien',
        ]);
        User::create([ // 9
            'nomor_handphone' => '08983847308',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'pasien',
        ]);
        User::create([ // 10
            'nomor_handphone' => '08983847309',
            // 'foto' => fake()->imageUrl($width = 640, $height = 480),
            'password' => bcrypt('1'),
            'status' => 'pasien',
        ]);
    }
}