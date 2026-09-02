<?php

namespace Database\Seeders;

use App\Models\InventoryItem;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     InventoryItem::factory()->count(10)->create();
    // }
    public function run(): void
    {
        InventoryItem::factory()->count(10)->sequence(
            ['name' => 'Neogel',   'variant' => '200'],
            ['name' => 'Neogel',   'variant' => '215'],
            ['name' => 'Cordtex',  'variant' => '5'],
            ['name' => 'Cordtex',  'variant' => '10'],
            ['name' => 'Expando',  'variant' => '2.4'],
            ['name' => 'Expando',  'variant' => '3.6'],
            ['name' => 'Detonex',  'variant' => '4.9'],
            ['name' => 'Detonex',  'variant' => '38'],
            ['name' => 'Blastpro', 'variant' => '10'],
            ['name' => 'Blastpro', 'variant' => '38'],
        )->create();
    }

}
