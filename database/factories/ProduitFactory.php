<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'designation' => $this->faker->sentence,
            'prix_u' => $this->faker->randomFloat(2, 1, 500),
            'quantite_stock' => $this->faker->numberBetween(0, 1200),
            'categorie_id' => Categorie::all()->random()->id,
            "image" => $this->faker->randomElement([
                "products\images\hodie1.jpg",
                "products\images\hodie2.jpg",
                "products\images\hodie3.jpg",
                "products\images\hodie4.jpg",
                "products\images\hodie5.jpg",
                "products\images\hodie6.jpg",
            ])

            //
        ];
    }
}
