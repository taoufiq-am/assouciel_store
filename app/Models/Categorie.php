<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;

    protected $tableName = "categories";
    protected $fillable= [
        'designation',
        'description'
    ];
    public function produits(){
        return $this->hasMany(Produit::class);
    }
}
