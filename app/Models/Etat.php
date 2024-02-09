<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commande;


class Etat extends Model
{
    use HasFactory;
    protected $tableName = "etats";

    protected $fillable = [
        "intitule","description","prevEtat"
    ];

    public function commandes(){
        return $this->hasMany(Commande::class);
    }

    public function next(){
        return $this->hasMany(Etat::class, 'prevEtat', 'id');
    }
}
