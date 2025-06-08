<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Pop',
            'Rock',
            'Hip Hop',
            'R&B',
            'Electronic',
            'Jazz',
            'Classical',
            'Country',
            'Blues',
            'Folk',
            'Metal',
            'Reggae',
            'Soul',
            'Funk',
            'Gospel',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => "A collection of {$category} music",
                'is_active' => true,
            ]);
        }
    }
} 