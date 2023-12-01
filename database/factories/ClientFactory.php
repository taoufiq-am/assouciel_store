<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom"=>$this->faker->lastName,
            "prenom"=>$this->faker->firstName,
            "ville"=>$this->faker->city,
            "adresse"=>$this->faker->address,
            "tele"=>$this->faker->phoneNumber
            //
        ];
    }
}
