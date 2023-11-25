<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->all() == []){
            $produits = Produit::all();
            return view("produits.index",compact("produits"));
        }else{
            $param = $request->val_search;
            if($param == null){
                $produits = Produit::all();
                return redirect()->route("produits.index", compact("produits"));
            }else{
                $produits = Produit::where('id', 'like', "%" . $param . "%")->orWhere('designation', 'like', "%" . $param . "%")->get();
                return view("produits.index",compact("produits"));
            }
        }
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view("produits.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "designation" => "required|unique:produits,designation",
            "prix_u" => "required",
            "quantite_stock" => "required",
            "categorie_id" => "required"
        ]);
        Produit::create($request->all());
        return redirect()->route("produits.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produit = Produit::find($id);

        return view('produits.show')->with("produit", $produit);

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produit = Produit::find($id);
        $produits = Produit::all();
        return view('produits.edit', compact('produit', "produits"));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "designation" => "required|unique:prouduits,designation," . $id,
            "prix_u" => "required",
            "quantite_stock" => "required",
            "categorie_id" => "required"
        ]);
        $produit = Produit::find($id);
        $produit->update($request->all());
        return redirect()->route('produits.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Produit::destroy($id);
        return  redirect()->route('produits.index');
    }
}
