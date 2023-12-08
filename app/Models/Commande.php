<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $tableName = "commandes";

    protected $fillable = [

        "etat_id","client_id"
    ];

}
