<?php

namespace Database\Seeders;

use App\Models\InventoryType;
use Illuminate\Database\Seeder;

class InventoryTypeSeeder extends Seeder
{
    public function run(): void
    {
        InventoryType::factory()->count(5)->create();
    }
}
