<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin user
        User::create([
            'name' => 'Admin Riyadussalikin',
            'email' => 'admin@riyadussalikin.sch.id',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
    }
}
