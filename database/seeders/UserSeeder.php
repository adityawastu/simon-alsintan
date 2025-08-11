<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Mektan',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $upja = User::create([
            'name' => 'UPJA Cibeber',
            'email' => 'upja@example.com',
            'password' => Hash::make('password'),
            'role' => 'upja',
        ]);

        $user = User::create([
            'name' => 'Petani A',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'farmer',
        ]);
    }
}
