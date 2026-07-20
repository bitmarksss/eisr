<?php

namespace Database\Factories;

use App\Models\{
    InventoryItem,
    InventoryStock,
    Level
};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryStock>
 */
class InventoryStockFactory extends Factory
{
    protected $model = InventoryStock::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = $this->faker->randomElement(['surface', 'underground']);

        return [
            // Automatically maps the inventory item link
            'item_id' => InventoryItem::factory(), 
            'location' => $location,
            
            // Evaluates location condition to set or strip the underground level mapping
            'level_id' => $location === 'underground' ? Level::factory() : null, 
            
            'quantity' => $this->faker->numberBetween(10, 500),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Explicit state state modifier for testing dedicated surface stock
     */
    public function surface(): static
    {
        return $this->state(fn (array $attributes) => [
            'location' => 'surface',
            'level_id' => null,
        ]);
    }

    /**
     * Explicit state modifier for testing dedicated underground level stock
     */
    public function underground(?int $levelId = null): static
    {
        return $this->state(fn (array $attributes) => [
            'location' => 'underground',
            'level_id' => $levelId ?? Level::factory(),
        ]);
    }
}