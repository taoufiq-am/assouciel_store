<?php

namespace Database\Seeders;

use App\Models\Etat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data=[
            [
                'intitule'=>'En attente de confirmation',
                'description'=>'en attente de confirmation',
                "prvEtat"=>null
            ],
            [
                'intitule'=>'Confirmée',
                'description'=>'confirmée',
                "prvEtat"=> 1

            ],
            [
                'intitule'=>'Anuller',
                'description'=>'Anuller',
                "prvEtat"=>1

            ],
            [
                'intitule'=>'Envoyée',
                'description'=>'envoyée',
                "prvEtat"=>2
            ],
            [
                'intitule'=>'Payée',
                'description'=>'payée',
                "prvEtat"=>4
            ],
            [
                'intitule'=>'Retournée',
                'description'=>'retournée',
                "prvEtat"=>4
            ],

        ];
        Etat::insert($data);
    }
}
