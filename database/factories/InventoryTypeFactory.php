<?php

namespace Database\Factories;

use App\Models\InventoryType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<InventoryType>
 */
class InventoryTypeFactory extends Factory
{
    protected $model = InventoryType::class;

    public function definition(): array
    {
        return [
            'type' => fake()->word(),
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}
