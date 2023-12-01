@extends('layouts.admin')
@section('title', 'Gestion des produits')
@section('content')
    <h1>Liste des Produits</h1>
    <form action="{{ route('produits.index') }}" method="get" >
        <div>
            <label for="filter_designation">Designation : </label>
            <input type="text" id="filter_designation" name="filter_designation" placeholder="Filtre par Designation"
                value="{{ isset($param) ? $param : '' }}">
        </div>
        <div>
            <label for="filter_categorie">Categorie : </label>
            <select name="filter_categorie" id="filter_categorie">
                @foreach ($categories as $cat)
                <option value="{{$cat->id}}">{{$cat->designation}}</option>
                @endforeach
            </select>
           
        </div>
        <div>
            <label for="prix_u">Prix : </label>
            <input type="hidden" name="prix_u_min" id="prix_u_min">
            <input type="hidden" name="prix_u_max" id="prix_u_max">
            <!--   ----------------------   -->
            <span id="lower-price">0</span>MAD
            <div id="price-range-slider">
            </div>
            <span id="upper-price">1000</span>MAD
        </div>

        <!--   ----------------------   -->

        <div>
            <label for="filter_quantite_stock">Quantite en stock : </label>
            <input type="text" id="filter_quantite_stock" name="filter_quantite_stock" placeholder="Filtre par Quantite en stock"
                value="{{ isset($param) ? $param : '' }}">
        </div>
        

        <input type="submit" value="Appliquer" name="search" >
    </form>
    <table id="tbl">
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
                <td>{{ $produit->categorie_id }} - {{$produit->Categorie->designation}}</td>
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
    <div>
        {{ $produits->links() }}
    </div>
@endsection