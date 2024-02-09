<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\CommandeController;

class HomeController extends Controller
{
    //
    public function index()
    {
        $probiluider = Produit::query();
        $produits = $probiluider->paginate(10);
        $categories = Categorie::all();
        $params = [
            "filter_designation" => "",
            "filter_categorie" => "",
            "prix_u_min" => 0,
            "prix_u_max" => 1000,
        ];

        //session()->forget(["produits_out_stock", "produits_on_stock"]);


        return view('home.index', compact('produits', "categories", "params"));
    }

    /* add prouduct to cart  */
    public function add(Request $request)
    {
        $produitsOnStock = session()->get("produits_on_stock", []);
        $productExists = false;
        foreach ($produitsOnStock as $key => $value) {
            if ($value["id"] == $request->id) {
                $stock=Produit::find($value["id"])->quantite_stock;
                if ($request->recalcule) {
                    $produitsOnStock[$key]["quantite"] = $request->quantite;
                } elseif($produitsOnStock[$key]["quantite"] + $request->quantite < $stock) {
                    $produitsOnStock[$key]["quantite"] += $request->quantite;
                }
                $productExists = true;
                break;
            }
        }
        if (!$productExists) {
            $produitsOnStock[] = ["id" => $request->id, "quantite" => $request->quantite];
        }

        session()->put("produits_on_stock", $produitsOnStock);

        if ($request->recalcule) {
            return redirect()->route("home.show");
        } else {
            return redirect()->route("home.index");
        }
    }

    // show cart
    public function show()
    {

        $produits = array_merge(session()->get("produits_on_stock", []), session()->get("produits_out_stock", []));

        $onStockItems = [];
        $outStockItems = [];
        $produits_on_stock = [];
        $produits_out_stock = [];
        $sum = 0;
        foreach ($produits as $key => $value) {
            $produit = Produit::find($value["id"]);
            $itemToShow = [
                "produit" => $produit,
                "quantite" => $value["quantite"]
            ];
            $itemToStore = [
                "id" => $value["id"],
                "quantite" => $value["quantite"]
            ];
            if ($produit->quantite_stock == 0) {
                $outStockItems[] = $itemToShow;
                $produits_out_stock[] = $itemToStore;
            } else {
                $sum += $itemToShow["quantite"] * $itemToShow["produit"]->prix_u;
                $onStockItems[] = $itemToShow;
                $produits_on_stock[] = $itemToStore;
            }
        }
        session()->put("produits_out_stock", $produits_out_stock);
        session()->put("produits_on_stock", $produits_on_stock);

        return view("home.show", compact("onStockItems", "sum", "outStockItems"));
    }
    // remove a product from cart
    public function destroy(Request $request,$id)
    {
        $onStock=true;
        if($request->onStock){
            $produits = session()->get("produits_on_stock");
        }else{
            $produits = session()->get("produits_out_stock");
            $onStock=false;

        }
        foreach ($produits as $key => $value) {
            if ($value["id"] == $id) {
                unset($produits[$key]);
            }
        }
        $onStock?session()->put("produits_on_stock", $produits):session()->put("produits_out_stock", $produits);
        return redirect()->back();
    }
    // remove all cart products

    public function clear()
    {
        session()->forget("produits_on_stock");
        session()->forget("produits_out_stock");

        return redirect()->route('home.index');
    }
    //search
    public function search(Request $request)
    {
        $produitsBuilder = Produit::query();
        $notFound = "";

        $designation = $request->query("filter_designation");
        $categorie = $request->query("filter_categorie");
        $prix_u_min = $request->query("prix_u_min");
        $prix_u_max = $request->query("prix_u_max");
        $orderPrix = $request->query("orderPrix");


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

        if ($orderPrix != null) {
            $produitsBuilder->orderBy('prix_u', $orderPrix);
        }
        $params = [
            "filter_designation" => $designation,
            "filter_categorie" => $categorie,
            "prix_u_min" => $prix_u_min,
            "prix_u_max" => $prix_u_max,
        ];

        if ($produitsBuilder->count() == 0 && Produit::all()->count() != 0) {
            $notFound = "Aucun produit trouve";
        }

        $produits = $produitsBuilder->paginate(30)->appends($params);

        $categories = Categorie::all();
        return view("home.index", [
            'produits' => $produits,
            "categories" => $categories,
            "notFound" => $notFound,
            "params" => $params
        ]);
    }
    // show the client commandes
    public function myOrders(Request $request)
    {
        $commandesBuilder = Commande::query();
        $notFound = "";
        if ($request->etat) {
            $commandesBuilder->where("etat_id", $request->etat);
        }
        $clientId = session()->get('client_id');
        $commandes = $commandesBuilder->where("client_id", $clientId)->get();

        if ($commandes->count() == 0) {
            $notFound = "not found";
        }
        $etats = Etat::all();
        return view("home.my_orders", compact("commandes", "etats", "notFound"));
    }
}
