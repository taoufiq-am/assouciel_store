<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\CommandeController;

class ClientController extends Controller
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
    public function create(Request $request)
    {
        if ($request->session()->has("client_id")) {
            return view("commandes.confirm");
        } else {
            return view("clients.create");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validateData = $request->validate(
            [
                "nom" => "required",
                "prenom" => "required",
                "ville" => "required",
                "tele" => "required",
                "adresse" => "required"
            ]
        );

        $client = Client::create($validateData);
        $request->session()->put("client_id", $client->id);
        //return redirect()->route("commandes.store");
        return view("commandes.confirm");
    }

    public function confirm(){
        return view("clients.confirm");
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        if(session("client_id")){
            $id=session("client_id");
            $client = Client::find($id);
            return view("clients.show", compact("client"));
        }else{
            return view("clients.create");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client=Client::find($id);
        return view("clients.edit", compact("client"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validateData = $request->validate(
            [
                "nom" => "required",
                "prenom" => "required",
                "ville" => "required",
                "tele" => "required",
                "adresse" => "required"
            ]
        );

        $client = Client::find(session()->get("client_id"));
        $client->update($validateData);
        $request->session()->put("client_id", $client->id);
        //return redirect()->route("commandes.store");
        return redirect()->route("clients.show",["client"=>$client]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
