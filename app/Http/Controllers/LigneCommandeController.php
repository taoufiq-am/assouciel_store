<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LigneCommande;

class LigneCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($commande_id)
    {
        foreach (session()->get("produits") as $cmdLigne) {
            // dd([
            //     "qte"=> $cmdLigne["quantite"],
            //     "produit_id"=> $cmdLigne["id"],
            //     "commande_id"=> $commande_id
            // ]);
            LigneCommande::create([
                "qte"=> $cmdLigne["quantite"],
                "produit_id"=> $cmdLigne["id"],
                "commande_id"=> $commande_id    
            ]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
