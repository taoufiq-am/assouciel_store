@extends('layouts.admin')
@section('title', 'show cart')
@section('content')
    @if ($onStockItems)
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
    @endif



@endsection
