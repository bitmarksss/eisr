<?php

namespace Database\Factories;

use App\Models\InventoryItem;
use App\Models\Level;
use App\Models\StockMovement;
use App\Models\StockMovementItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMovementItem>
 */
class StockMovementItemFactory extends Factory
{
    protected $model = StockMovementItem::class;

    /**
     * Define the model's default state.
     * Defaults to standard Surface -> Underground Issuance transfer pattern.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stock_movement_id'    => StockMovement::factory(),
            'item_id'              => InventoryItem::factory(),
            'source_location'      => 'surface',
            'source_level_id'      => null,
            'destination_location' => 'underground',
            'destination_level_id' => Level::factory(),
            'quantity'             => $this->faker->numberBetween(1, 100),
            'remarks'              => $this->faker->optional(0.5)->realText(30),
            'created_at'           => now(),
            'updated_at'           => now(),
        ];
    }

    /**
     * State modifier for underground-to-surface returns
     */
    public function returnToSurface(): static
    {
        return $this->state(fn (array $attributes) => [
            'source_location'      => 'underground',
            'source_level_id'      => Level::factory(),
            'destination_location' => 'surface',
            'destination_level_id' => null,
        ]);
    }
}