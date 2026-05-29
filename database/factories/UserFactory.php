<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
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
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => []);
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            // Check if roles exist, if not, Spatie might not be seeded yet
            try {
                if (!$user->hasRole('admin') && !$user->hasRole('lecturer') && !$user->hasRole('student')) {
                    $user->assignRole('student');
                }
            } catch (\Exception $e) {
                // In some test contexts, roles table might not be seeded
            }

            if (!$user->student && !$user->lecturer) {
                \App\Models\Student::create([
                    'user_id' => $user->id,
                    'name' => 'Test User',
                    'npm' => 'NPM-' . rand(100000, 999999),
                ]);
            }
        });
    }

}
