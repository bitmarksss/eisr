<?php

namespace Database\Factories;

use App\Models\DailyReportsItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyReportsItemFactory extends Factory
{
    protected $model = DailyReportsItem::class;
    public function definition(): array
    {
        return ['detail_id' => \App\Models\DailyReportsDetail::factory(), 'item_id' => \App\Models\InventoryItem::factory(), 'quantity' => $this->faker->randomFloat(3, 1, 100)];
    }
}
