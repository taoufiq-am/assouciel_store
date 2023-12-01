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
                    <td>{{ $item['produit']->prix_u }}</td>
                    <td><a href="{{route("home.destroy",["id"=>$item['produit']->id])}}">remove</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection
