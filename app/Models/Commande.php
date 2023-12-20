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

    public function etat(){
        return $this->belongsTo(Etat::class);
    }

    public function produits(){
        return $this->belongsToMany(Produit::class,"lignecommandes")->withPivot("qte");
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }

}
