<?php

namespace Database\Factories;

use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMovement>
 */
class StockMovementFactory extends Factory
{
    protected $model = StockMovement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference_no' => 'ISS-' . strtoupper(Str::random(6)),
            'movement_date'=> $this->faker->date(),
            'type'         => $this->faker->randomElement(['receive', 'issuance', 'return', 'adjustment', 'transfer']),
            'user_id'      => 1,
            'notes'        => $this->faker->optional(0.7)->sentence(),
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}