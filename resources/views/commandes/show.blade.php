@extends('layouts.admin')
@section('title', 'Home')
@section('content')

    <h3>Detaile du commande</h3>

    <table class="table center  align-middle  caption-top">
        <tr>
            <th>Id</th>
            <td>{{ $commande->id }}</td>
        </tr>
        <tr>
            <th>Etat</th>
            <td>{{ $commande->etat->intitule }}</td>
        </tr>
        <tr>
            <th>Date de commande</th>
            <td>{{ $commande->created_at }}</td>
        </tr>
        <tr>
            <th>Date de livraison</th>
            <td>{{ $deliveredDate }}</td>
        </tr>
    </table>
    <h3>Client infos</h3>
    <table class="table center  align-middle  caption-top">
        <tr>
            <th>Nom</th>
            <td>{{ $client->nom }}</td>
        </tr>
        <tr>
            <th>Prenom</th>
            <td>{{ $client->prenom }}</td>
        </tr>
        <tr>
            <th>tele</th>
            <td>{{ $client->tele }}</td>
        </tr>
        <tr>
            <th>adresse</th>
            <td>{{ $client->adresse }}</td>
        </tr>
        <tr>
            <th>Ville</th>
            <td>{{$client->ville }}</td>
        </tr>
    </table>

    <h3>list des produits</h3>
    <table class="table center  align-middle text-center caption-top">
        <thead>
            <tr>
                <th scope="col">Id produit</th>
                <th scope="col">Image</th>
                <th scope="col">designation</th>
                <th scope="col">Quantite demander</th>
                <th scope="col">Prix</th>
                <th scope="col">Prix x Quantite demander</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commande->produits as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><img width="100" height="100" src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->designation }}"></td>
                    <td>{{ $item->designation }}</td>

                    <td>{{ $item->pivot->qte }}</td>


                    <td>{{ $item->prix_u }} MAD</td>
                    <td id="pxq{{ $item->id }}">{{ $item->prix_u * $item->pivot->qte }}
                        <span>MAD</span>
                    </td>

                </tr>
            @endforeach
            <tr>
                <th colspan="5" class="bg-success">total </th>
                <td id="sum">{{ $sum }} MAD</td>
            </tr>


        </tbody>
    </table>


@endsection
