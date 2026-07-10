<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        // Create 15 pending stock requests without signatures
        Stock::factory()->count(15)->create();

        // Create 10 completed, fully-signed stock requests
        Stock::factory()->count(10)->approved()->create();
    }
}