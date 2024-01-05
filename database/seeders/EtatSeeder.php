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
                'description'=>'en attente de confirmation'
            ],
            [
                'intitule'=>'Confirmée',
                'description'=>'confirmée'
            ],
            [
                'intitule'=>'Anuller',
                'description'=>'Anuller'
            ],
            [
                'intitule'=>'Envoyée',
                'description'=>'envoyée'
            ],
            [
                'intitule'=>'Payée',
                'description'=>'payée'
            ],
            [
                'intitule'=>'Retournée',
                'description'=>'retournée'
            ],

        ];
        Etat::insert($data);
    }
}
