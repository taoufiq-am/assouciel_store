@extends('layouts.user')
@section('title', 'Info')
@section('content')
    <h2>Add Client</h2>

    <form action="{{route("clients.store")}}" method="post">
        @csrf
    <div>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom"  value="{{old("nom")}}">
    </div>
    <div>
        <label for="prenom">Prenom:</label>
        <input type="text" id="prenom" name="prenom"  value="{{old("prenom")}}">
    </div>
<div>
        <label for="tele">Tele:</label>
        <input type="tel" id="tele" name="tele"  value="{{old("tele")}}">
    </div>
    <div>
    
        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville"  value="{{old("ville")}}">
    </div>
    <div>
    
        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse"  value="{{old("adresse")}}">
    </div>
    <div>
        <input type="submit" value="buy now">
    </div>
    </form>

<div>
    @if($errors->all())
    @foreach($errors->all() as $err)
    <p>{{$err}}</p>
    @endforeach
    @endif
</div>



@endsection
