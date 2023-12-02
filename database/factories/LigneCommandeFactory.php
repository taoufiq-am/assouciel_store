<?php

namespace Database\Factories;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\LigneCommande;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LigneCommande>
 */
class LigneCommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "prouduit_id"=>Produit::all()->random()->id,
            "commande_id"=>Commande::all()->random()->id
            //
        ];
    }
}
