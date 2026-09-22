<?php

namespace Database\Factories;

use App\Models\StockRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<StockRequest>
 */
class StockRequestFactory extends Factory
{
    protected $model = StockRequest::class;

    public function definition(): array
    {
        return [
            'reference_no' => 'REQ-' . strtoupper(Str::random(8)),
            'date' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'requested_by' => User::factory(),
        ];
    }
}
