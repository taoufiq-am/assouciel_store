@extends('layouts.admin')
@section('title','Detail d \'une categorie')
@section('content')
   <a href="{{route('produits.index')}}">Retourner vers la liste des produits</a>
   <h1>Detail de le produit Num {{$produit->id}}</h1>
   <div>
       <p><strong>Designation:</strong> {{$produit->designation}}</p>
       <p><strong>Prix unitaire:</strong> {{$produit->prix_u}}</p>
       <p><strong>Quantite on stock:</strong> {{$produit->quantite_stock}}</p>
       <p><strong>N° Categorie:</strong> {{$produit->categorie_id}}</p>
   </div>
@endsection