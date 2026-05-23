<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Avis;
use App\Models\Commentaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Commentaire>
 */
class CommentaireFactory extends Factory
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
            'avis_id' => Avis::factory(),
            'isLitige' => fake()->boolean(),
            'isVisible' => true,
            'contenu' => fake()->paragraph(),
        ];
    }

    /**
     * Indicate that the commentaire should be hidden.
     */
    public function hidden(): static
    {
        return $this->state(fn (array $attributes) => [
            'isVisible' => false,
        ]);
    }

    /**
     * Indicate that the commentaire is a dispute.
     */
    public function withLitige(): static
    {
        return $this->state(fn (array $attributes) => [
            'isLitige' => true,
        ]);
    }
}
