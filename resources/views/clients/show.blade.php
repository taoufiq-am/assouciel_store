@extends('layouts.user')
@section('title', 'info')
@section('content')

    <h3>Nom :</h3>
    <p>{{ $client->nom }}</p>
    <h3>Prenom :</h3>
    <p>{{ $client->prenom }}</p>
    <h3>Ville : </h3>
    <p>{{ $client->ville }}</p>
    <h3>Adresse : </h3>
    <p>{{ $client->adresse }}</p>
    <h3>Tel : </h3>
    <p>{{ $client->tele }}</p>
    <form action="{{route("commandes.store")}}" method="post">
        @csrf
        <input type="submit" value="use this infos">
    </form>
    <form action="{{route("clients.edit",["client"=>$client])}}" methode="get">
        <input type="submit" value="modefy infos">
    </form>
    

@endsection
