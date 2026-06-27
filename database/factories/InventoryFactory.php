<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
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
            'sku' => fake()->unique()->lexify('EXP-???-') . fake()->numerify('####'), 
            'name' => ucwords(fake()->words(2, true)),
            'category' => fake()->randomElement(['Bulk Explosives', 'Initiators', 'Boosters', 'Detonators']), 
            'quantity' => fake()->numberBetween(0, 300), 
        ];
    }
}