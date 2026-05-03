<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Politics',
            'National News',
            'World News',
            'Business & Economy',
            'Sports',
            'Technology',
            'Health',
            'Education',
            'Entertainment',
            'Lifestyle',

            // Newsroom extras
            'Advertisements',
            'Tenders',
            'Announcements',
            'Opinion',
            'Editorial',
            'Breaking News',
            'Trending',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}