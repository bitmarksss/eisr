<?php

namespace Database\Factories;

use App\Models\DailyReportItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class DailyReportItemFactory extends Factory
{
    protected $model = DailyReportItem::class;
    public function definition(): array
    {
        return ['detail_id' => \App\Models\DailyReportDetail::factory(), 'item_id' => \App\Models\InventoryItem::factory(), 'quantity' => $this->faker->randomFloat(3, 1, 100)];
    }
}
