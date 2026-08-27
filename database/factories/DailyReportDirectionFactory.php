<?php

namespace Database\Factories;

use App\Models\DailyReportDirection;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyReportDirectionFactory extends Factory
{
    protected $model = DailyReportDirection::class;
    public function definition(): array
    {
        return ['detail_id' => \App\Models\DailyReportDetail::factory(), 'direction' => $this->faker->randomElement(['North', 'South', 'East', 'West']), 'type' => $this->faker->randomElement(['PB', 'SB']), 'distance' => $this->faker->numberBetween(1, 500)];
    }
}
