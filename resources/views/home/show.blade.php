@extends('layouts.admin')
@section('title', 'show cart')
@section('content')
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
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item['produit']->id }}</td>
                    <td><img width="100" height="100" src="{{ asset($item['produit']->image) }}"
                            alt="{{ $item['produit']->designation }}"></td>
                    <td>{{ $item['produit']->designation }}</td>
                    <td>{{ $item['quantite'] }}</td>
                    <td>{{ $item['produit']->prix_u }} MAD</td>
                    <td>{{ $item['produit']->prix_u * $item['quantite'] }} MAD</td>
                    <td>
                        <form action="{{ route('home.destroy', ['id' => $item['produit']->id]) }}" method="get">
                            @method('delete')
                            @csrf
                            <input type="submit" value="remove"
                                onclick="return confirm('are you sure about deleting this product')">
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <th colspan="5" class="bg-success">total </th>
                <td>{{$sum}} MAD</td>
            </tr>
        </tbody>
    </table>



@endsection
