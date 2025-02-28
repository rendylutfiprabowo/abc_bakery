<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        // Pastikan ada role Owner di tabel roles
        $ownerRole = Role::firstOrCreate(['name' => 'Owner']);

        // Tambahkan user dengan role Owner
        User::create([
            'name' => 'Rendy Lutfi Prabowo',
            'email' => 'rendylutfiprabowo123@gmail.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'role_id' => $ownerRole->id,
            'is_verified' => true, // Tandai sebagai sudah diverifikasi
            'terms' => true, // Tandai sebagai sudah diverifikasi
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'branchmanager',
            'email' => 'bm123@gmail.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'role_id' => 2,
            'is_verified' => true, // Tandai sebagai sudah diverifikasi
            'terms' => true, // Tandai sebagai sudah diverifikasi
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'cashier',
            'email' => 'cashier123@gmail.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'role_id' => 3,
            'is_verified' => true, // Tandai sebagai sudah diverifikasi
            'terms' => true, // Tandai sebagai sudah diverifikasi
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'productionofficer',
            'email' => 'productionofficer123@gmail.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'role_id' => 4,
            'is_verified' => true, // Tandai sebagai sudah diverifikasi
            'terms' => true, // Tandai sebagai sudah diverifikasi
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'logisticofficer',
            'email' => 'logisticofficer123@gmail.com',
            'password' => Hash::make('password123'), // Ganti dengan password yang aman
            'role_id' => 5,
            'is_verified' => true, // Tandai sebagai sudah diverifikasi
            'terms' => true, // Tandai sebagai sudah diverifikasi
            'email_verified_at' => now(),
        ]);
    }
}
