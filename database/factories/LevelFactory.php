<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    protected $model = Level::class;

    // A static counter to ensure levels are generated sequentially (L1, L2, L3...)
    protected static int $sequenceNumber = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currentNumber = self::$sequenceNumber++;

        return [
            'name'        => "Floor {$currentNumber}",
            'code'        => "L{$currentNumber}",
            'sort_order'  => $currentNumber,
            'description' => "Automated storage layout deck for floor level {$currentNumber}.",
            'is_active'   => true,
        ];
    }
}