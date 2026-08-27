<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DailyReportHeader;
use App\Models\Level;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyReportHeader>
 */
class DailyReportHeaderFactory extends Factory
{
    protected $model = DailyReportHeader::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return ['report_date' => $this->faker->date(), 'level_id' => Level::inRandomOrder()->value('id')];
    }
}
