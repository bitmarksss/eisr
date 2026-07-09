<?php

namespace Database\Seeders;

use App\Models\UnitOfMeasurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitOfMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnitOfMeasurement::insert([
            ['unit' => 'PCS'],
            ['unit' => 'KG'],
            ['unit' => 'BOXES'],
            ['unit' => 'METER'],
        ]);
    }
}
