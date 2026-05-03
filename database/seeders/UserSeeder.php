<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        // Editor
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor User',
                'password' => Hash::make('password'),
            ]
        );
        $editor->assignRole('editor');

        // Journalist
        $journalist = User::firstOrCreate(
            ['email' => 'journalist@example.com'],
            [
                'name' => 'Journalist User',
                'password' => Hash::make('password'),
            ]
        );
        $journalist->assignRole('journalist');
    }
}