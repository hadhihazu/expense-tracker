<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sources')->insert([
            ['name' => 'Salary', 'user_id' => 1],  // Assuming user_id 1 exists
            ['name' => 'Bonus', 'user_id' => 1],
            ['name' => 'Award', 'user_id' => 1],
            ['name' => 'Gift', 'user_id' => 1]
        ]);
    }
}
