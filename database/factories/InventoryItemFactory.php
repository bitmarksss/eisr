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
            'item_code' => fake()->unique()->lexify('EXP-???-') . fake()->numerify('####'),
            'supplier_id' => fake()->numberBetween(1, 10),

            'name' => fake()->randomElement([
                'Neogel',
                'Cordtex',
                'Expando',
                'Detonex',
                'Blastpro',
            ]),

            'variant' => function (array $attributes) {
                return match ($attributes['name']) {
                    'Neogel' => fake()->randomElement([200, 215]),
                    'Cordtex' => fake()->randomElement([5, 10]),
                    'Expando' => fake()->randomElement([2.4, 3.6]),
                    'Detonex' => fake()->randomElement([4.9, 38]),
                    'Blastpro' => fake()->randomElement([10, 38]),
                };
            },

            'kind_id' => fake()->numberBetween(1, 5),
            'cost' => fake()->randomFloat(1, 15, 100),
            'uom' => fake()->randomElement([1, 2, 3, 4]),
        ];

    }
}