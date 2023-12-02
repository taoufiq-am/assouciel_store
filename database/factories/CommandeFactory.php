<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Etat;
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
            "client_id"=>Client::all()->random()->id,
            "etat_id"=>Etat::all()->random()->id,
            //
        ];
    }
}
