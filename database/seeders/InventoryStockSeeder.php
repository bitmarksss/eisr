<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use App\Models\InventoryStock;
use App\Models\Level;
use Illuminate\Database\Seeder;

class InventoryStockSeeder extends Seeder
{
    public function run(): void
    {
        $items = InventoryItem::all();
        $levels = Level::all();

        foreach ($items as $item) {

            // Create surface stock
            InventoryStock::factory()
                ->surface($item->id)
                ->create();

            // Create underground stock for every level
            foreach ($levels as $level) {
                InventoryStock::factory()
                    ->underground($item->id, $level->id)
                    ->create();
            }
        }
    }
}
