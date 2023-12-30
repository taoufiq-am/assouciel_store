@extends('layouts.user')
@section('title', 'Home')
@section('content')
    <form action="{{ route('home.search') }}" method="get">
        <div>
            <label for="filter_designation">Designation : </label>
            <input type="text" id="filter_designation" name="filter_designation" placeholder="Filtre par Designation"
                value="{{ $params['filter_designation'] }}"
                >
        </div>
        <div>
            <label for="filter_categorie">Categorie : </label>
            <select name="filter_categorie" id="filter_categorie">
                <option value="">choisir une categprie............</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->designation }}</option>
                @endforeach
            </select>

        </div>
        <div>
            <label for="prix_u">Prix : </label>
            <input type="hidden" name="prix_u_min" id="prix_u_min" value="0">
            <input type="hidden" name="prix_u_max" id="prix_u_max" value="1000">
            <!--   ----------------------   -->
            <span id="lower-price">0</span>MAD
            <div id="price-range-slider">
            </div>
            <span id="upper-price">1000</span>MAD
        </div>

        <!--   ----------------------   -->

        <div>
            <label for="" name="orderPrix">Prix order : </label>
            <label for="asc">croissante</label>
            <input type="radio" value="asc"  id="asc" name="orderPrix" checked>
            <label for="desc">decroissante</label>
            <input type="radio" value="desc" id="desc" name="orderPrix">
             </div>


        <input type="submit" value="Appliquer" name="search">
    </form>
    @if (isset($notFound))
    <h1>{{$notFound}}</h1>
    <a href="{{route("home.index")}}">back to home</a>
    @endif
        
    
    <div class="container">
        <div class="row justify-content-evenly">
            @foreach ($produits as $produit)
                <div class="card" style="width: 16rem; height:30 rem">
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
    {{ $produits->links() }}
@endsection
