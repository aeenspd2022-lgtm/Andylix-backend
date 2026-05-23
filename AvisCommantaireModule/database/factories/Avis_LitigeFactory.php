<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Avis;
use App\Models\Avis_Litige;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Avis_Litige>
 */
class AvisLitigeFactory extends Factory
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
            'avis_id' => Avis::factory(),
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
