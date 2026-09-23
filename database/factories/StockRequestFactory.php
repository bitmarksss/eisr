<?php

namespace Database\Factories;

use App\Models\{
    StockRequest,
    User
};
use App\Services\ReferenceNumberService;
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
        $referenceService = app(ReferenceNumberService::class);

        return [
            'reference_no' => $referenceService->generate('OEC', 'PMC-OEC'),
            'date' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'requested_by' => User::factory(),
        ];
    }
}
