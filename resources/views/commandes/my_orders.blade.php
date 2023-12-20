@extends('layouts.admin')
@section('title', 'Home')
@section('content')
    <form action="{{ route('commandes.myOrders') }}">
        <label for="etat">Etat</label>
        <select name="etat" id="etat">
            @foreach ($etats as $etat)
                <option value="{{ $etat->id }}">{{ $etat->intitule }}</option>
            @endforeach
        </select>
        <input type="submit" value="Filrer">
    </form>
    @if ($notFound)
    <h1>{{$notFound}}</h1>
    <a href="{{route("commandes.myOrders")}}">go back to all commandes</a>
    @endif
    <table class="table center  align-middle text-center caption-top">
        <thead>
            <tr>
                <th class="col ">ID</th>
                <th class="col ">etat</th>
                <th class="col ">date</th>
                <th class="col ">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commandes as $commande)
                <tr>
                    <td class="col ">{{ $commande->id }}</td>
                    <td class="col ">{{ $commande->etat->intitule }}</td>
                    <td class="col ">{{ $commande->created_at }}</td>
                    <td class="col ">
                        <form action="{{ route('commandes.show', ['commande' => $commande->id]) }}">
                            <input type="submit" name="" id="" value="detail">
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>


@endsection
