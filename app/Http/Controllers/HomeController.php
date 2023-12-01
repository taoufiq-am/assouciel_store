<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    function index()
    {
        $produits = Produit::all();
        return view("home.index", compact("produits"));
    }

    /* add prouduct to cart  */
    function add(Request $request)
    {
        session()->push("produits", ["id" => $request->id, "quantite" => $request->quantite]);
        return redirect()->route("home.index");
    }
    function show()
    {
        $sessionProduits = session()->get("produits");
        $cartItems = [];
        foreach ($sessionProduits as $produit) {
            $item = [
                "produit" => Produit::find($produit["id"]),
                "quantite" => $produit["quantite"]
            ];
            array_push($cartItems, $item);
        }
        // dd($cartItems);
        return view("home.show", compact("cartItems"));
    }
}
