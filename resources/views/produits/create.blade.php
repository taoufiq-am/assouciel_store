@extends('layouts.admin')
@section('title', 'cree un produit')
@section('content')
    <h1>Ajouter un produit</h1>
    <form action="{{ route('produits.store') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <div>
            <label for="designation">Designation</label>
            <input type="text" name="designation" value="{{old("designation")}}">
        </div>
        <div>
            <label for="prix_u">Prix unitaire</label>
            <input type="number" min="1" name="prix_u" id="prix_u" value="{{old("prix_u")}}">
            <span>DH</span>

        </div>
        <div>
            <label for="quantite_stock">Quantite on stock</label>
            <input type="number" min="0"  name="quantite_stock" id="quantite_stock" value="{{old("quantite_stock")}}">
        </div>
        <div>
            <label for="categorie_id">N° Categorie</label>
            <select name="categorie_id" id="categorie_id">
                <option value="">Select la categorie -----------</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->id }} - {{ $categorie->designation }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="file" name="image" id="image" accept="image/*" onchange="showImage(this)">
            <img src="" alt="" id="productImg">
        </div>
        <div>
            <input type="submit" value="Ajouter">
            <input type="reset" value="Vider">
        </div>
        
    </form>
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
@endsection
