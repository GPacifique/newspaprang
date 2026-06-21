<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@news.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@news.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Journalist User',
            'email' => 'journalist@news.com',
            'password' => Hash::make('password'),
            'role' => 'journalist',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Normal Reader',
            'email' => 'reader@news.com',
            'password' => Hash::make('password'),
            'role' => 'reader',
            'status' => 'active',
        ]);
    }
}