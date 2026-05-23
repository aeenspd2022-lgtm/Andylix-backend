<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Commentaire;
use App\Models\Commentaire_Litige;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Commentaire_Litige>
 */
class CommentaireLitigeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artisan_id' => User::factory(),
            'commentaire_id' => Commentaire::factory(),
            'contenu' => fake()->paragraph(),
            'isResolu' => fake()->boolean(),
        ];
    }

    /**
     * Indicate that the dispute is resolved.
     */
    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'isResolu' => true,
        ]);
    }

    /**
     * Indicate that the dispute is unresolved.
     */
    public function unresolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'isResolu' => false,
        ]);
    }
}
