<?php

namespace Database\Factories;

use App\Models\DailyReportDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyReportDetailFactory extends Factory
{
    protected $model = DailyReportDetail::class;
    public function definition(): array
    {
        return [
            'header_id' => \App\Models\DailyReportHeader::factory(), 
            'shift_no' => $this->faker->numberBetween(1, 3), 
            'contractor_name' => $this->faker->company(), 
            'support' => $this->faker->name(), 
            'drill_steel' => $this->faker->numberBetween(1, 20), 
            'working_place' => $this->faker->streetName()
        ];
    }
}
