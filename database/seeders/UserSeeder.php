<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run(): void
{
    \App\Models\Admin\User::create([
            'name'          => 'Admin Utama',
            'email'         => 'admin@example.com',
            'password'      => Hash::make('admin@example.com'),
            'nip'           => '1987654321',
            'no_hp'         => '081234567890',
            'jabatan'       => 'Administrator',
            'unit_kerja'    => 'Teknologi Informasi',
            'wilayah_kerja' => 'Cianjur',
            'role'          => 'admin',
            'image'         => 'default-avatar.png',
        ]);
}
}
