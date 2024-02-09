@extends('layouts.layout')
@section('title','Detail d \'une categorie')
@section('space-work')
   <a class="btn btn-primary my-3" href="{{route('produits.index')}}">Retourner vers la liste des produits</a>
   <div class="produit">
       <form>
        <h3 class="text-center">Detail de le produit Num {{$produit->id}}</h3>
        <p><strong>Designation:</strong> {{$produit->designation}}</p>
        <p><strong>Prix unitaire:</strong> {{$produit->prix_u}}</p>
        <p><strong>Quantite on stock:</strong> {{$produit->quantite_stock}}</p>
        <p><strong>N° Categorie:</strong> {{$produit->categorie_id}}</p>
        <p><strong>image</strong></p>
        <img class="img-pro" src="{{asset("storage/".$produit->image)}}" alt="{{$produit->designation}}">
    </form>
   </div>
@endsection
