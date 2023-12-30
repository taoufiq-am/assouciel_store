@extends('layouts.user')
@section('title', 'Info')
@section('content')
    <h2>Add Client</h2>

    <form action="{{ route('clients.update', ['client' => $client->id]) }}" method="post">
        @method('put')
        @csrf
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="{{ $client->nom }}">
        </div>
        <div>
            <label for="prenom">Prenom:</label>
            <input type="text" id="prenom" name="prenom" value="{{ $client->prenom }}">
        </div>
        <div>
            <label for="tele">Tele:</label>
            <input type="tel" id="tele" name="tele" value="{{ $client->tele }}">
        </div>
        <div>

            <label for="ville">Ville:</label>
            <input type="text" id="ville" name="ville" value="{{ $client->ville }}">
        </div>
        <div>

            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" value="{{ $client->adresse }}">
        </div>
        <div>
            <input type="submit" value="modify info">
        </div>
    </form>

    <div>
        @if ($errors->all())
            @foreach ($errors->all() as $err)
                <p>{{ $err }}</p>
            @endforeach
        @endif
    </div>



@endsection
