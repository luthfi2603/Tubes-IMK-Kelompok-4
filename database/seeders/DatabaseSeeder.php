<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        $this->call(UserSeeder::class);
        $this->call(PasienSeeder::class);
        $this->call(DokterSeeder::class);
        $this->call(PerawatSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ReservasiSeeder::class);
        $this->call(RekamMedisSeeder::class);
        $this->call(WaktuSeeder::class);
        $this->call(JadwalDokterSeeder::class);
        $this->call(KamarSeeder::class);
        $this->call(RawatInapSeeder::class);
    }
}