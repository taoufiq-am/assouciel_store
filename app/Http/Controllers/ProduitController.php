<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produitsBuilder = Produit::query();

        $designation = $request->query("filter_designation");
        $categorie = $request->query("filter_categorie");
        $prix_u_min = $request->query("prix_u_min");
        $prix_u_max = $request->query("prix_u_max");
        $quantite = $request->query("filter_quantite_stock");

        if ($designation != null) {
            $produitsBuilder->where('designation', 'like', '%' . $designation . '%');
        }
        if ($categorie != null) {
            $produitsBuilder->where('categorie_id', $categorie);
        }
        if ($prix_u_min != null) {
            $produitsBuilder->where('prix_u', '>=', $prix_u_min);
        }

        if ($prix_u_max != null) {
            $produitsBuilder->where('prix_u', '<=', $prix_u_max);
        }

        if ($quantite != null) {
            $produitsBuilder->where('quantite_stock', '=', $quantite);
        }
        $param = [
            "filter_designation" => $designation,
            "filter_categorie" => $categorie,
            "prix_u_min" => $prix_u_min,
            "prix_u_max" => $prix_u_max,
            "filter_quantite_stock" => $quantite
        ];
        if(!$produitsBuilder){}
        $produits = $produitsBuilder->paginate(5)->appends($param);

        $categories = Categorie::all();
        return view("produits.index", [
            'produits' => $produits,
            "categories" => $categories
        ]);
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
        $validateData=$request->validate([
            "designation" => "required|unique:produits,designation",
            "prix_u" => "required",
            "quantite_stock" => "required",
            "categorie_id" => "required",
            "image"=>"image|mimes:jpeg,png,jpeg,gif,svg|max:2048"
        ]);
       
        if($request->hasFile("image")){
            $imagePath=$request->file("image")->store("products/images","public");
            $validateData["image"]= $imagePath;
        }
        Produit::create($validateData);
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
            "categorie_id" => "required",
            "image"=>"image|mimes:jpeg|png|jpeg|gif|svg|max:2048"

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
