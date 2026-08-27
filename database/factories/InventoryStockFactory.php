<?php

namespace Database\Factories;

use App\Models\InventoryStock;
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
     * The item_id and level_id are supplied by the seeder.
     */
    public function definition(): array
    {
        return [
            'item_id' => null,
            'location' => 'surface',
            'level_id' => null,
            'quantity' => fake()->numberBetween(10, 500),
        ];
    }

    /**
     * Surface stock.
     */
    public function surface(int $itemId): static
    {
        return $this->state([
            'item_id' => $itemId,
            'location' => 'surface',
            'level_id' => null,
        ]);
    }

    /**
     * Underground stock for a specific level.
     */
    public function underground(int $itemId, int $levelId): static
    {
        return $this->state([
            'item_id' => $itemId,
            'location' => 'underground',
            'level_id' => $levelId,
        ]);
    }
}
