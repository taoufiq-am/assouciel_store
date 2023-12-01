<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Etate;
use App\Models\LigneCommande;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "ligne_commande_id"=>LigneCommande::all()->random()->id,
            "id_client"=>Client::all()->random()->id,
            "id_etat"=>Etate::all()->random()->id,
            //
        ];
    }
}
