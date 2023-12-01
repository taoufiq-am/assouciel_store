@extends('layouts.admin')
@section('title', 'Info')
@section('content')
    <h2>Add Client</h2>

    <form action="" method="post">
        @csrf
    
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" >
    
        <label for="prenom">Prenom:</label>
        <input type="text" id="prenom" name="prenom" >
    
        <label for="tele">Tele:</label>
        <input type="tel" id="tele" name="tele" >
    
        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" >
    
        <label for="adresse">Adresse:</label>
        <textarea id="adresse" name="adresse" required></textarea>
    
        <input type="submit" value="buy now">
    </form>





@endsection
