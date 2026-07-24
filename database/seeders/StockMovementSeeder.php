<?php

namespace Database\Seeders;

use App\Models\{
    InventoryItem,
    Level,
    StockMovement,
    StockMovementItem
};
use Illuminate\Database\Seeder;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get or create pools for levels and items
        $levels = Level::all();
        if ($levels->isEmpty()) {
            $levels = Level::factory()->count(4)->create();
        }

        $items = InventoryItem::all();
        if ($items->isEmpty()) {
            $items = InventoryItem::factory()->count(10)->create();
        }

        // 2. Create 5 multi-item movement batches
        foreach (range(1, 5) as $i) {
            $movement = StockMovement::factory()->create([
                'type' => 'issuance',
                'notes' => 'Explosives Daily Transfer Batch #' . $i,
            ]);

            // Create 8-15 line items distributed across levels
            foreach (range(1, rand(8, 15)) as $index) {
                StockMovementItem::factory()->create([
                    'stock_movement_id'    => $movement->id,
                    'item_id'              => $items->random()->id,
                    'source_location'      => 'surface',
                    'source_level_id'      => null,
                    'destination_location' => 'underground',
                    'destination_level_id' => $levels->random()->id,
                    'quantity'             => rand(10, 500),
                ]);
            }
        }
    }
}