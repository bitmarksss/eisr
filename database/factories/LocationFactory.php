<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        $number = $this->faker->unique()->numberBetween(1, 99);
        return ['name' => "Location {$number}", 'code' => "LOC-{$number}", 'sort_order' => $number, 'description' => $this->faker->optional()->sentence(), 'is_active' => true];
    }
}
