<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@news.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // EDITOR
        User::create([
            'name' => 'Editor User',
            'email' => 'editor@news.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
        ]);

        // JOURNALIST
        User::create([
            'name' => 'Journalist User',
            'email' => 'journalist@news.com',
            'password' => Hash::make('password'),
            'role' => 'journalist',
        ]);

        // NORMAL USER (reader)
        User::create([
            'name' => 'Normal User',
            'email' => 'user@news.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}