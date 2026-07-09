<?php

namespace Database\Factories;

use App\Models\Role;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_name' => fake()->lastName(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->lastName(), // Randomly generates a name or null
            'position' => fake()->randomElement([
                'Manager',
                'Supervisor',
                'Engineer',
                'Technician',
                'Operator',
                'Warehouse Clerk',
                'Purchasing Officer',
                'Safety Officer',
                'Accountant',
                'Administrative Assistant',
            ]),
            'role_id' => Role::inRandomOrder()->first()?->id ?? 1, // Grabs an existing role ID, defaults to 1
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'username' => fake()->unique()->userName(),
            'password' => Hash::make('password'), // Always hash passwords!
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
