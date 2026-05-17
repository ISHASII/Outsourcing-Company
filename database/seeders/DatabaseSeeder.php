<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'hrd@gmail.com'],
            [
                'name' => 'Akun HRD',
                'role' => 'hrd',
                'password' => bcrypt('1234567890'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'pelamar@gmail.com'],
            [
                'name' => 'Akun Pelamar',
                'role' => 'pelamar',
                'password' => bcrypt('1234567890'),
            ]
        );
    }
}
