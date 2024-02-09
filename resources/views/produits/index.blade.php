@extends('layouts.layout')
@section('title', 'Gestion des produits')
@section('space-work')
    <h1>Liste des Produits</h1>
        {{-- <div>
            <label for="prix_u">Prix : </label>
            <input type="hidden" name="prix_u_min" id="prix_u_min" value="0">
            <input type="hidden" name="prix_u_max" id="prix_u_max" value="1000">
            <!--   ----------------------   -->
            <span id="lower-price">0</span>MAD
            <div id="price-range-slider">
            </div>
            <span id="upper-price">1000</span>MAD
        </div> --}}

        <!--   ----------------------   -->
        <form class="form-inline" action="{{ route('produits.index') }}" method="get">
            <div class="form-group mx-sm-3 mb-2">
               <label for="filter_designation" class="text-dark mr-2" style="font-size: 1.25em">Designation :</label>
              <input type="text" class="form-control border " id="filter_designation" name="filter_designation" placeholder="Designation" value="{{ $params['filter_designation'] }}">
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="filter_categorie" class="text-dark mr-2" style="font-size: 1.25em">Categorie :</label>
              <select class="form-control border" style="width: 20em" name="filter_categorie" id="filter_categorie">
                <option value="">choisir une categprie...</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->designation }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="filter_quantite_stock" class="text-dark mr-2" style="font-size: 1.25em">Quantite en stock :</label>
               <input type="text" class="form-control border " id="filter_quantite_stock" name="filter_quantite_stock" placeholder="Quantite en stock" value="{{ $params['filter_quantite_stock'] }}">
             </div>
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
          </form>
          <div class="d-flex justify-content-between my-3">
            <a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter une nouvelle produit</a>
            <a href="{{ route('produits.clear') }}" class="btn btn-danger">Supprimer tous les produits</a>
        </div>
    <table id="tbl" class="table center  align-middle text-center caption-top">

        <tr>
            <th>ID</th>
            <th>Designation</th>
            <th>Prix unitaire</th>
            <th>Quantite on stock</th>
            <th>N° Categorie</th>
            <th colspan="3">Action</th>
        </tr>
        @if ($notFound)
        <tr>
            <td colspan="6">La list est vide <a href="{{ route("produits.index") }}">Retourner a la list</a></td>
         </tr>
        @else
        @foreach ($produits as $produit)
            <tr>
                <td>{{ $produit->id }}</td>
                <td>{{ $produit->designation }}</td>
                <td>{{ $produit->prix_u }}</td>
                <td>{{ $produit->quantite_stock }}</td>
                <td>{{ $produit->categorie_id }} - {{ $produit->Categorie->designation }}</td>
                <td><a class="btn btn-secondary" href="{{ route('produits.show', ['produit' => $produit->id]) }}">Details</a></td>
                <td><a class="btn btn-success" href="{{ route('produits.edit', ['produit' => $produit->id]) }}">Modifier</a></td>
                <td>
                    <form action="{{ route('produits.destroy', ['produit' => $produit->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="submit"
                            onclick="return confirm('voulez vous supprimer le produit ayant lid {{ $produit->id }}')"
                            class="btn btn-danger" value="supprimer">
                    </form>
                </td>
            </tr>
        @endforeach
        @endif
    </table>
    <div>
        {{ $produits->links() }}
    </div>
@endsection
