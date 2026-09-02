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
        // `unique()` must apply to the pair, not to name or variant separately.
        $pair = fake()->randomElement([
            'Neogel|200', 'Neogel|215',
            'Cordtex|5', 'Cordtex|10',
            'Expando|2.4', 'Expando|3.6',
            'Detonex|4.9', 'Detonex|38',
            'Blastpro|10', 'Blastpro|38',
        ]);
        [$name, $variant] = explode('|', $pair, 2);

        return [
            'item_code' => fake()->unique()->lexify('EXP-???-') . fake()->numerify('####'),
            'supplier_id' => fake()->numberBetween(1, 10),
            'name' => $name,
            'variant' => $variant,

            'kind_id' => fake()->numberBetween(1, 5),
            'cost' => fake()->randomFloat(1, 15, 100),
            'uom' => fake()->randomElement([1, 2, 3, 4]),
        ];

    }
}
