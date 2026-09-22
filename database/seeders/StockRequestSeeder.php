<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use App\Models\StockRequest;
use App\Models\StockRequestItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class StockRequestSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->get();
        $items = InventoryItem::query()->get();

        if ($users->isEmpty()) {
            $users = User::factory()->count(3)->create();
        }

        if ($items->isEmpty()) {
            $items = InventoryItem::factory()->count(10)->create();
        }

        StockRequest::factory()
            ->count(10)
            ->state(fn () => ['requested_by' => $users->random()->id])
            ->create()
            ->each(function (StockRequest $request) use ($items): void {
                StockRequestItem::factory()
                    ->count(fake()->numberBetween(1, 4))
                    ->state(fn () => [
                        'stock_request_id' => $request->id,
                        'item_id' => $items->random()->id,
                    ])
                    ->create();
            });
    }
}
