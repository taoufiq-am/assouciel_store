<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\CommandeController;

class HomeController extends Controller
{
    //
    public function index()
    {
        $produits = Produit::all();
        return view("home.index", compact("produits"));
    }

    /* add prouduct to cart  */
    public function add(Request $request)
    {
        $sessionProduits = session()->get("produits", []);
        $productExists = false;
        foreach ($sessionProduits as $key => $product) {
            if ($product["id"] == $request->id) {
                if ($request->recalcule) {
                    $sessionProduits[$key]["quantite"] = $request->quantite;
                } else {
                    $sessionProduits[$key]["quantite"] += $request->quantite;
                }
                $productExists = true;
                break;
            }
        }
        if (!$productExists) {
            $produits = Produit::find($request->id);
            $sessionProduits[] = ["id" => $produits->id, "quantite" => $request->quantite];
        }
        session()->put("produits", $sessionProduits);
        if ($request->recalcule) {
            return redirect()->route("home.show");
        } else {
            return redirect()->route("home.index");
        }
    }

    // show cart 
    public function show()
    {
        $sessionProduits = session()->get("produits", []);
        $cartItems = [];
        $sum = 0;
        foreach ($sessionProduits as $produit) {
            $item = [
                "produit" => Produit::find($produit["id"]),
                "quantite" => $produit["quantite"]
            ];
            $sum += $item["quantite"] * $item["produit"]->prix_u;
            $cartItems[] = $item;
        }
        return view("home.show", compact("cartItems", "sum"));
    }
// remove a product from cart
    public function destroy($id)
    {
        $sessionProduits = session()->get("produits");
        foreach ($sessionProduits as $key => $value) {
            if ($value["id"] == $id) {
                unset($sessionProduits[$key]);
            }
        }
        session()->put("produits", $sessionProduits);
        return redirect()->back();
    }
// remove all cart products

    public function clear()
    {
        session()->forget("produits");

        return redirect()->route('home.index');
    }

   
}
