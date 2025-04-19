<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::firstOrCreate([
            'email' => 'editor@example.com',
        ], [
            'name' => 'Editor User',
            'password' => Hash::make('password'),
            'role' => 'editor',
        ]);
        User::firstOrCreate([
            'email' => 'viewer@example.com',
        ], [
            'name' => 'Viewer User',
            'password' => Hash::make('password'),
            'role' => 'viewer',
        ]);

    }
}
