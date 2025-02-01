<?php

namespace Database\Factories;

use App\Models\Income;
use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition()
    {
        return [
            'source_id' => Source::inRandomOrder()->first()->id ?? Source::factory(),
            'user_id' => $this->faker->numberBetween(1, 10),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->sentence(),
        ];
    }
}
