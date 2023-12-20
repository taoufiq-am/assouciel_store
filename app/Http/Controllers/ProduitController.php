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
        $notFound = false;

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
        $params = [
            "filter_designation" => $designation,
            "filter_categorie" => $categorie,
            "prix_u_min" => $prix_u_min,
            "prix_u_max" => $prix_u_max,
            "filter_quantite_stock" => $quantite
        ];

        if ($produitsBuilder->count() == 0 && Produit::all()->count() != 0) {
            $notFound = "Aucun produit trouve";
        } elseif ($produitsBuilder->count() < Produit::all()->count()) {
            $notFound = " ";
        }

        $produits = $produitsBuilder->paginate(5)->appends($params);

        $categories = Categorie::all();
        return view("produits.index", [
            'produits' => $produits,
            "categories" => $categories,
            "notFound" => $notFound,
            "params" => $params
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
        $validateData = $request->validate([
            "designation" => "required|unique:produits,designation",
            "prix_u" => "required",
            "quantite_stock" => "required",
            "categorie_id" => "required",
            "image" => "image|mimes:jpeg,png,jpeg,gif,svg|max:2048"
        ]);

        if ($request->hasFile("image")) {
            $imagePath = $request->file("image")->store("products/images", "public");
            $validateData["image"] = $imagePath;
        }
        Produit::create($validateData);
        return redirect()->route("produits.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produit = Produit::find($id); #
        return view('produits.show')->with("produit", $produit);

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produit = Produit::find($id);
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', "categories"));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produitsOnStock=session()->get("produits_on_stock",[]);
        
        foreach($produitsOnStock as $key => $value){
            if ($value["id"] == $id && $value["quantite"] > $request->quantite_stock && $request->quantite_stock!=0) {
                $produitsOnStock[$key]["quantite"] = $request->quantite_stock;
                session()->put("produits_on_stock", $produitsOnStock);   
                break;
            }
        }

        $validateData = $request->validate([
            "designation" => "required|unique:produits,designation," . $id,
            "prix_u" => "required",
            "quantite_stock" => "required",
            "categorie_id" => "required",
            "image" => "image|mimes:jpeg,png,jpeg,gif,svg|max:2048"
        ]);

        if ($request->hasFile("image")) {
            $imagePath = $request->file("image")->store("products/images", "public");
            $validateData["image"] = $imagePath;
        }
        $produit = Produit::find($id);
        $produit->update($validateData);
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

    public function clear()
    {
        DB::table("produits")->delete();
        return redirect()->route("produits.index");
    }
}
