@extends('layouts.admin')
@section('title', 'Gestion des produits')
@section('content')
    <h1>Liste des Produits</h1>
    <table id="tbl">
        <form action="{{ route('produits.index') }}" method="get">
            <label for="chercher">chercher</label>
            <input type="text" id="chercher" name="val_search" value="{{old("val_search")}}">
            <input type="submit" value="Chercher">
        </form>
        <div>
            <a href="{{ route('produits.create') }}">Ajouter un noveau produit</a>
        </div>
        <tr>
            <th>ID</th>
            <th>Designation</th>
            <th>Prix unitaire</th>
            <th>Quantite on stock</th>
            <th>N° Categorie</th>
            <th colspan="3">Action</th>
        </tr>
        @foreach ($produits as $produit)
            <tr>
                <td>{{ $produit->id }}</td>
                <td>{{ $produit->designation }}</td>
                <td>{{ $produit->prix_u }}</td>
                <td>{{ $produit->quantite_stock }}</td>
                <td>{{ $produit->categorie_id }} - {{ $produit->categorie->designation }}</td>
                <td><a href="{{ route('produits.show', ['produit' => $produit->id]) }}">Details</a></td>
                <td><a href="{{ route('produits.edit', ['produit' => $produit->id]) }}">Modifier</a></td>
                <td>
                    <form action="{{ route('produits.destroy', ['produit' => $produit->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="submit"
                            onclick="return confirm('voulez vous supprimer le produit ayant lid {{ $produit->id }}')"
                            value="supprimer">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
