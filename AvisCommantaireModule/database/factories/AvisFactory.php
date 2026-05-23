<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Avis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Avis>
 */
class AvisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'artisan_id' => User::factory(),
            'contenu' => fake()->paragraph(),
            'isLitige' => fake()->boolean(),
            'isVisible' => true,
        ];
    }

    /**
     * Indicate that the avis should be hidden.
     */
    public function hidden(): static
    {
        return $this->state(fn (array $attributes) => [
            'isVisible' => false,
        ]);
    }

    /**
     * Indicate that the avis is a dispute.
     */
    public function withLitige(): static
    {
        return $this->state(fn (array $attributes) => [
            'isLitige' => true,
        ]);
    }
}
