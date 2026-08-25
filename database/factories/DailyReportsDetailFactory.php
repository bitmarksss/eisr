<?php

namespace Database\Factories;

use App\Models\DailyReportsDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyReportsDetailFactory extends Factory
{
    protected $model = DailyReportsDetail::class;
    public function definition(): array
    {
        return ['header_id' => \App\Models\DailyReportsHeader::factory(), 'contractor_name' => $this->faker->company(), 'support' => $this->faker->name(), 'drill_steel' => $this->faker->numberBetween(1, 20), 'working_place' => $this->faker->streetName()];
    }
}
