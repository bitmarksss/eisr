<?php

namespace Database\Seeders;

use App\Models\InventoryKind;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryKindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryKind::insert([
            ['kind' => 'Emulsion'],
            ['kind' => 'Blasting Agent'],
            ['kind' => 'Blasting Fuse'],
            ['kind' => 'Detonators'],
            ['kind' => 'Detonating Cord'],
        ]);
    }
}
