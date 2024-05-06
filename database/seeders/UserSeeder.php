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
            'nomor_telepon' => '08983847300',
            'password' => bcrypt('1'),
            'status' => 'admin',
        ]);
        User::create([ // 2
            'nomor_telepon' => '08983847301',
            'password' => bcrypt('1'),
            'status' => 'dokter',
        ]);
        User::create([ // 3
            'nomor_telepon' => '08983847302',
            'password' => bcrypt('1'),
            'status' => 'perawat',
        ]);
        User::create([ // 4
            'nomor_telepon' => '08983847303',
            'password' => bcrypt('1'),
            'status' => 'pasien',
        ]);
        User::create([ // 5
            'nomor_telepon' => '08983847304',
            'password' => bcrypt('1'),
            'status' => 'pasien',
        ]);
    }
}