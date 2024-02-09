@extends('layouts.layout')
@section('title', 'Modifier un produit')
@section('space-work')
<div class="produit">
    <form action="{{ route('produits.update', ['produit' => $produit->id]) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <h3 class="text-center">Modifier un produit</h3>
            <div>
                <label for="designation">Designation</label>
                <input type="text" name="designation" value="{{ $produit->designation }}">
            </div>
            <div>
                <label for="prix_u">Prix unitaire</label>
                <input type="number" min="1" name="prix_u" id="prix_u" value="{{ $produit->prix_u }}">
                <span>DH</span>

            </div>
            <div>
                <label for="quantite_stock">Quantite on stock</label>
                <input type="number" min="0" name="quantite_stock" id="quantite_stock"
                    value="{{ $produit->quantite_stock }}">
            </div>
            <div>
                <label for="image">Image</label>
                <input type="file" name="image" id="image" value="{{ asset($produit->image) }}" accept="image/*" onchange="showImage(this)">
                <img class="img-pro" src="{{ asset("storage/".$produit->image) }}" alt="{{$produit->designation}}" id="productImg">
            </div>
            <div>
                <label for="categorie_id">N° Categorie</label>
                <select name="categorie_id" id="categorie_id">
                    <option value="{{ $produit->categorie_id }}" default>{{ $produit->categorie_id }} -
                        {{ $produit->categorie->designation }}</option>
                    @foreach ($categories as $cat)
                        @if ($cat->id !== $produit->categorie_id)
                            <option value="{{ $cat->id }}">{{ $cat->id }} - {{ $cat->designation }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <input class="button" type="submit" value="Modifier">
                <input class="button" type="reset" value="Vider">
            </div>
        </form>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
</div>
@endsection
