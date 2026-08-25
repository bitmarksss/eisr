<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DailyReportsHeader;
use App\Models\Location;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyReportsHeader>
 */
class DailyReportsHeaderFactory extends Factory
{
    protected $model = DailyReportsHeader::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return ['report_date' => $this->faker->date(), 'location_id' => Location::factory()];
    }
}
