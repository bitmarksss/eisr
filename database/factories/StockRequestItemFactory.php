<?php

namespace Database\Factories;

use App\Models\InventoryItem;
use App\Models\StockRequest;
use App\Models\StockRequestItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockRequestItem>
 */
class StockRequestItemFactory extends Factory
{
    protected $model = StockRequestItem::class;

    public function definition(): array
    {
        return [
            'stock_request_id' => StockRequest::factory(),
            'item_id' => InventoryItem::factory(),
            'quantity' => fake()->numberBetween(1, 100),
            'remarks' => fake()->optional()->sentence(),
        ];
    }
}
