<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etat>
 */
class EtatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $etats = ['En attente de confirmation', 'Confirmée', 'Envoyée', 'Payée', 'Retournée'];
        return [
            "intitule" =>$this->faker->unique()->randomElement($etats),
            "description" => $this->faker->sentence
            //
        ];
    }
}
