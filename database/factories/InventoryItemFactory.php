<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generates uppercase alphanumeric formats like "EXP-DET-8423"
            'item_code' => fake()->unique()->lexify('EXP-???-') . fake()->numerify('####'), 
            'supplier_id' => fake()->numberBetween(1, 10),
            // 'location' => fake()->randomElement(['surface', 'underground']),
            'name' => ucwords(fake()->words(2, true)),
            'kind_id' => fake()->numberBetween(1, 5),
            'cost' => fake()->randomFloat(1, 15, 100),
            'uom' => fake()->randomElement([1, 2, 3, 4]),
            // 'quantity' => fake()->numberBetween(0, 300), 
        ];
    }
}