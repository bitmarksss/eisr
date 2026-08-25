<?php

namespace Database\Factories;

use App\Models\DailyReportsDirection;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyReportsDirectionFactory extends Factory
{
    protected $model = DailyReportsDirection::class;
    public function definition(): array
    {
        return ['detail_id' => \App\Models\DailyReportsDetail::factory(), 'direction' => $this->faker->randomElement(['North', 'South', 'East', 'West']), 'type' => $this->faker->randomElement(['PB', 'SB']), 'distance' => $this->faker->numberBetween(1, 500)];
    }
}
