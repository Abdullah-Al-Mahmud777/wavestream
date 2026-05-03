<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists
        User::firstOrCreate(
            ['email' => 'admin@wavestream.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        // Create a test regular user
        User::firstOrCreate(
            ['email' => 'user@wavestream.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('user123'),
                'is_admin' => false,
            ]
        );
    }
}
