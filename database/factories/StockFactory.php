<?php

namespace Database\Factories;

use App\Models\Stock;
use App\Models\UnitOfMeasurement;
use App\Models\User;
use App\Models\Uom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    public function definition(): array
    {
        // Pluck a random dynamic kind from your predefined options
        $kinds = ['Emulsion', 'Blasting Agent', 'Blasting Fuse', 'Detonators', 'Detonating Cord'];
        
        return [
            'status' => 'pending',
            'kind' => Arr::random($kinds),
            'type' => $this->faker->words(2, true), // Simulates inventory item name
            'quantity' => [
                'supplier_id' => $this->faker->numberBetween(1, 10),
                'quantity' => $this->faker->numberBetween(5, 500),
            ],
            'uom_id' => UnitOfMeasurement::inRandomOrder()->first()?->id ?? UnitOfMeasurement::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'remarks' => $this->faker->optional(0.7)->sentence(),
            // 'prepared_by' => null,
            // 'reviewed_by' => null,
            // 'noted_by' => null,
            // 'endorsed_by' => null,
            // 'approved_by' => null,
            // 'noted_by_2' => null,
            // 'approved_by_2' => null,
        ];
    }

    /**
     * State for a fully approved and signed stock request.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            // 'prepared_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            // 'reviewed_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            // 'noted_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            // 'endorsed_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            // 'approved_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            // 'noted_by_2' => User::inRandomOrder()->first()?->id ?? User::factory(),
            // 'approved_by_2' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ]);
    }
}