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
        return [
            // This will automatically create an Inventory record if one isn't passed
            'item_id' => InventoryItem::factory(), 
            'location' => $this->faker->randomElement(['surface', 'underground']),
            'level_id' => Level::factory(), 
            'quantity' => $this->faker->numberBetween(0, 500),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}