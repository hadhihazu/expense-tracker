<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Category;
use App\Models\Income;
use Illuminate\Database\Seeder;
use Database\Seeders\MonthSeeder;
use Database\Seeders\SourceSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //



        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(10)->create();

        // Category::factory(10)->create(); // Create categories
        $this->call(CategorySeeder::class);
        Expense::factory(50)->create(); // Create 50 fake expenses

        $this->call(MonthSeeder::class);
        Budget::factory(50)->create();

        $this->call(SourceSeeder::class);
        Income::factory(50)->create();
    }
}
