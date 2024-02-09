<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\LigneCommande;
use Illuminate\Support\Facades\DB;

class LigneCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(Request $request)
    {

        $commande_id = $request->session()->get('commande_id');
        $produitsOnStock = $request->session()->get('produits_on_stock');
        foreach ($produitsOnStock as $key=>$value){
            $produit=Produit::find($value["id"]);
            $produit->quantite_stock-= $value["quantite"];
            $produit->save();

        }

        foreach (session()->get("produits_on_stock") as $cmdLigne) {
            LigneCommande::create([
                "qte" => $cmdLigne["quantite"],
                "produit_id" => $cmdLigne["id"],
                "commande_id" => $commande_id
            ]);
        }
        $request->session()->forget(["commande_id", "produits_on_stock"]);
        return redirect()->route("home.index");
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
