@extends('layouts.admin')
@section('title', 'Home')
@section('content')
<table class="table center  align-middle  caption-top">
    <tr>
        <th>Id</th>
        <td>{{ $commande->id }}</td>
    </tr>
    <tr>
        <th>Etat</th>
        
        <td>{{ $commande->etat->intitule }}</td>
        <td>
            <form action="{{route("commandes.update",["commande"=>$commande->id])}}" method="post">
                @method("put")
                @csrf
            <select name="newEtat" id="">
                <option value="{{ $commande->etat->id }}" default>{{ $commande->etat->intitule }}</option>
                @foreach ($etats as $etat)
                @if($etat->id != $commande->etat->id)
                <option value="{{ $etat->id }}" >{{$etat->intitule }}</option>
                @endif
                @endforeach
            </select>
            <input type="submit" value="modifier">
        </form>
    </td>

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
@endsection
