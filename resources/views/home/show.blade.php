@extends('layouts.user')
@section('title', 'show cart')
@section('content')
    {{-- @if ($onStockItems)
        <a href="{{ route('home.clear') }}">Clear carts</a>
        <table class="table center  align-middle text-center caption-top">
            <caption>Cart Products</caption>

            <thead>
                <tr>
                    <th scope="col">Id produit</th>
                    <th scope="col">Image</th>
                    <th scope="col">designation</th>
                    <th scope="col">Quantite demander</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Prix x Quantite demander</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($onStockItems as $item)
                    <tr>
                        <td>{{ $item['produit']->id }}</td>
                        <td><img width="100" height="100" src="{{ asset('storage/' . $item['produit']->image) }}"
                                alt="{{ $item['produit']->designation }}"></td>
                        <td>{{ $item['produit']->designation }}</td>

                        <form action="{{ route('home.add', ['id' => $item['produit']->id]) }}">
                            <td><input type="number" value="{{ $item['quantite'] }}" min=1 name="quantite"
                                    max="{{ $item['produit']->quantite_stock }}">
                                <input type="submit" value="recalcule" name="recalcule">

                            </td>
                        </form>

                        <td>{{ $item['produit']->prix_u }} MAD</td>
                        <td id="pxq{{ $item['produit']->id }}">{{ $item['produit']->prix_u * $item['quantite'] }}
                            <span>MAD</span>
                        </td>
                        <td>
                            <form action="{{ route('home.destroy', ['id' => $item['produit']->id]) }}" method="get">
                                @method('delete')
                                @csrf
                                <input type="submit" value="remove" name="onStock"
                                    onclick="return confirm('are you sure to delete this product')">
                            </form>
                        </td>

                    </tr>
                @endforeach
                <tr>
                    <th colspan="5" class="bg-success">total </th>
                    <td id="sum">{{ $sum }} MAD</td>
                </tr>


            </tbody>
        </table>
        <form action="{{ route('clients.show', ['client' => 0]) }}">
            <input type="submit" value="Buy Now">
        </form>
    @else
        <h1>No itemes in the cart </h1>
        <a href="{{ route('home.index') }}">Add Items Now</a>
    @endif
    @if ($outStockItems)
        <h3>Out Of stock</h3>
        <table class="table center  align-middle text-center caption-top">
            <caption>Cart out stock  Products</caption>

            <thead>
                <tr>
                    <th scope="col">Id produit</th>
                    <th scope="col">Image</th>
                    <th scope="col">designation</th>
                    <th scope="col">Quantite demander</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Prix x Quantite demander</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($outStockItems as $item)
                <tr>
                    <td>{{ $item['produit']->id }}</td>
                    <td><img width="100" height="100" src="{{ asset('storage/' . $item['produit']->image) }}"
                            alt="{{ $item['produit']->designation }}"></td>
                    <td>{{ $item['produit']->designation }}</td>

                    <td>{{ $item['quantite'] }}</td>

                    <td>{{ $item['produit']->prix_u }} MAD</td>
                    <td id="pxq{{ $item['produit']->id }}">{{ $item['produit']->prix_u * $item['quantite'] }}
                        <span>MAD</span>
                    </td>
                    <td>
                        <form action="{{ route('home.destroy', ['id' => $item['produit']->id]) }}" method="get">
                            @method('delete')
                            @csrf
                            <input type="submit" value="remove" name="outStock"
                                onclick="return confirm('are you sure to delete this product')">
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
        </table>
    @endif --}}
<div class="show">

    @if (empty($onStockItems))
        <p class="mt-5 text-center">Votre panier est vide</p>
    @else
        <h1>Mon panier</h1>

        <table class="panier">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Designation</th>
                    <th>Image</th>
                    <th>Prix unitaire</th>
                    <th>Quantite</th>
                    <th>Total ligne</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($onStockItems as $id => $item)
                <tr>
                    <td>{{ $id }}</td>
                    <td><img width="100" height="100" src="{{ asset('storage/' . $item['produit']->image) }}"
                        alt="{{ $item['produit']->designation }}"></td>
                    <td>{{ $item['produit']->designation }}</td>
                    <td>{{ $item['produit']->prix_u }} MAD</td>
                    <form action="{{ route('home.add', ['id' => $item['produit']->id]) }}">
                        <td><input type="number" value="{{ $item['quantite'] }}" min=1 name="quantite"
                                max="{{ $item['produit']->quantite_stock }}">
                            <input type="submit" value="recalcule" name="recalcule">
                        </td>
                    </form>
                    <td>{{$item['quantite'] * $item['produit']->prix_u }} MAD</td>
                    <td>
                        <form action="{{ route('home.destroy', ['id' => $id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-supprimer"
                                onclick="return confirm('Voulez-vous supprimer cette ligne?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <th colspan="4">Total</th>
                    <td id="sum" colspan="2">{{ $sum }} MAD</td>
                </tr>
            </tbody>
        </table>

        <div class="actions">
            <a href="{{ route('clients.show', ['client' => 0]) }}" class="btn btn-commander">Commander</a>
            <a href="{{ route('home.clear') }}" class="btn btn-vider">Vider le panier</a>
        </div>
    @endif

</div>

@endsection
