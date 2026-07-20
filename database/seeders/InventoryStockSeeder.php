<?php

namespace Database\Seeders;

use App\Models\InventoryStock;
use App\Models\Level;
use Illuminate\Database\Seeder;

class InventoryStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure we have a small pool of Levels to work with so we don't 
        // create 25 unique levels for 25 underground stock items.
        $levels = Level::inRandomOrder()->take(5)->get();
        
        if ($levels->isEmpty()) {
            $levels = Level::factory()->count(5)->create();
        }

        // 2. Create 25 items strictly stored on the surface (level_id will be null)
        InventoryStock::factory()
            ->count(25)
            ->surface()
            ->create();

        // 3. Create 25 items assigned underground, randomly distributed across the levels
        foreach (range(1, 25) as $index) {
            InventoryStock::factory()
                ->underground($levels->random()->id) // Attaches to an existing level ID
                ->create();
        }
    }
}