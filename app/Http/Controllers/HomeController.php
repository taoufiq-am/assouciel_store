<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

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
        $sum = 1;
        foreach ($sessionProduits as $key => $product) {
            if ($product["id"] == $request->id) {
                $sessionProduits[$key]["quantite"] += $request->quantite;
                $productExists = true;
                break;
            }
        }
        if (!$productExists) {
            $produits = Produit::find($request->id);
            $sessionProduits[] = ["id" => $produits->id, "quantite" => $request->quantite];
        }
        session()->put("produits", $sessionProduits);

        return redirect()->route("home.index");
    }
    public function show()
    {
        $sessionProduits = session()->get("produits",[]);
        $cartItems = [];
        $sum=0;
        foreach ($sessionProduits as $produit) {
            $item = [
                "produit" => Produit::find($produit["id"]),
                "quantite" => $produit["quantite"]
            ];
            $sum += $item["quantite"] * $item["produit"]->prix_u;
            array_push($cartItems, $item);
        }
        return view("home.show", compact("cartItems","sum"));
    }

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

    public function clear(){
        session()->forget("produits");

        return redirect()->route('home.index');
    }
    public function storeInfo(){
        return view('home.buy');
    }
}
