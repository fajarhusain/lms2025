<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('198#####'),
            'email' => fake()->unique()->safeEmail(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'rank' => fake()->randomElement(['Guru', 'Staff', 'Admin']),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'province' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->country(),
            'phone_number' => fake()->phoneNumber(),
            'about' => fake()->sentence(),
            'place_of_birth' => fake()->city(),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(['L', 'P']),
            'religion' => fake()->randomElement(['Islam', 'Kristen', 'Hindu', 'Buddha']),
            'profile_picture' => null,
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['admin', 'user']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
