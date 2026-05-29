<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role Spatie ada
        \Spatie\Permission\Models\Role::findOrCreate('super_admin');
        \Spatie\Permission\Models\Role::findOrCreate('admin');
        \Spatie\Permission\Models\Role::findOrCreate('panel_user');

        // Buat admin user
        $user = User::create([
            'name' => 'Admin Riyadussalikin',
            'email' => 'admin@riyadussalikin.sch.id',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
            'role' => 'super_admin',
        ]);

        $user->assignRole('super_admin');
    }
}
