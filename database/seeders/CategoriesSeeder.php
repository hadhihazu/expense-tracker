<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        // Clear the table before seeding
        DB::table('categories')->truncate();

        // Insert dummy data
        $categories = [
            ['name' => 'Food', 'user_id' => 1],
            ['name' => 'Transportation', 'user_id' => 1],
            ['name' => 'Entertainment', 'user_id' => 1],
            ['name' => 'Utilities', 'user_id' => 1],
            ['name' => 'Rent', 'user_id' => 1],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
