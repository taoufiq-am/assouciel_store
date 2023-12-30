<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Etat;
use App\Models\Client;
use App\Models\Commande;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $commandesBuilder = Commande::query();
        $notFound = "";
        if ($request->etat) {
            $commandesBuilder->where("etat_id", $request->etat);
        }
        if ($request->nomClient) {
            $commandesBuilder->whereHas("client", function ($query) use ($request) {
                $query->where('nom', 'like', "%" . $request->nomClient . "%");
            });
        }
        if ($request->dateMin) {
            $commandesBuilder->whereDate("created_at", ">", $request->dateMin);
        }
        if ($request->dateMax) {
            $commandesBuilder->whereDate("created_at", "<", $request->dateMax);
        }
        if ($commandesBuilder->count() == 0) {
            $notFound = "not found";
        }
        $etats = Etat::all();
        $param = [
            "etat" => $request->etat,
            "nomClient" => $request->nomClient,
            "dateMin" => $request->dateMin,
            "dateMax" => $request->dateMax

        ];
        $commandesToExport = $commandesBuilder->get();
        $commandes = $commandesBuilder->paginate(10)->appends($param);
        $request->session()->put("commandesToExport",$commandesToExport);
        return view('commandes.index', compact('commandes', "notFound", "etats","commandesToExport"));
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
        $clientId = $request->session()->get("client_id");
        $commande = Commande::create(
            [
                "client_id" => $clientId,
                "etat_id" => 1
            ]
        );

        $request->session()->put("commande_id", $commande->id);
        return view("ligneCommandes.store");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commande = Commande::find($id);
        $deliveredDate = Carbon::parse($commande->created_at)->addDays(7);
        $sum = 0;
        foreach ($commande->produits as $produit) {
            $sum += $produit->prix_u * $produit->pivot->qte;
        }
        $client = Client::find($commande->client_id);
        return view("commandes.show", compact("commande", "deliveredDate", "sum", "client"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commande = Commande::find($id);
        $etats = Etat::all();
        $deliveredDate = Carbon::parse($commande->created_at)->addDays(7);

        return view("commandes.edit", compact("commande", "etats", "deliveredDate"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commande = Commande::find($id);
        $commande->etat_id = $request->newEtat;
        $commande->save();
        if($request->newEtat == 3 || $request->newEtat == 6){
            $produits=$commande->produits;
            foreach($produits as $produit){
                $produit->quantite_stock += $produit->pivot->qte;
                $produit->save();

            }

        }
        return redirect()->route("commandes.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commande = Commande::find($id);
        $commande->delete();
        return back();
    }

    

    public function exportCSV(Request $request)
    {
        
        $commandes = $request->session()->get("commandesToExport");
        
        $csvFileName = 'commandes.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['id', 'date', 'nom', 'prenom', 'ville', 'tele', 'total']);

        foreach ($commandes as $commande) {
            $sum = 0;
            foreach ($commande->produits as $produit) {
                $sum += $produit->prix_u * $produit->pivot->qte;
            }
            fputcsv($handle, [
                $commande->id,
                $commande->created_at,
                $commande->client->nom,
                $commande->client->prenom,
                $commande->client->ville,
                $commande->client->tele,
                $sum
            ]);
        }

        fclose($handle);

        return response()->make('', 200, $headers);
    }
}
