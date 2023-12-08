<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    use HasFactory;
    protected $table = 'ligneCommandes';

    protected $fillable = [
        "qte","produit_id","commande_id"
    ];
}
