<?php

namespace Database\Seeders;

use App\Models\StockRequest;
use Illuminate\Database\Seeder;

class StockRequestSeeder extends Seeder
{
    public function run(): void
    {
        // Create 15 pending stock requests without signatures
        StockRequest::factory()->count(15)->create();

        // Create 10 completed, fully-signed stock requests
        StockRequest::factory()->count(10)->approved()->create();
    }
}