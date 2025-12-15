<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil Class Seeder lainnya di sini
        $this->call([
            AdminUserSeeder::class, // Membuat User Admin & Biasa
            PejabatSeeder::class,   // Membuat Data Pejabat
        ]);
    }
}