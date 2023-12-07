@extends('layouts.admin')
@section('title', 'Home')
@section('content')
    <h1>Products</h1>
    <div class="container">
        <div class="row justify-content-evenly">
            @foreach ($produits as $produit)
                <div class="card" style="width: 18rem; height:30 rem">
                    <a href="{{ route('produits.show', ['id' => $produit->id, 'produit' => $produit]) }}">
                        <img src={{ asset('storage/' . $produit->image) }} class="card-img-top"
                            alt="{{ $produit->designation }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $produit->designation }}</h5>
                        <p class="card-text">{{ $produit->prix_u }} DH</p>
                        <p class="card-text">Quantite : {{ $produit->quantite_stock }} piece</p>
                        @if ($produit->quantite_stock != 0)
                            <form action="{{ route('home.add', ['id' => $produit->id]) }}">
                                <input type="number" min="1" max="{{ $produit->quantite_stock }}" name="quantite"
                                    value="1">
                                <input type="submit" class="btn btn-primary" value="Add to cart">
                            </form>
                        @else
                            <p>Stock out</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
