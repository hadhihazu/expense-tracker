<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Food', 'user_id' => 1],
            ['name' => 'Transportation', 'user_id' => 1],
            ['name' => 'Utilities', 'user_id' => 1],
            ['name' => 'Entertainment', 'user_id' => 1],
            ['name' => 'Health', 'user_id' => 1],
        ]);
    }
}
