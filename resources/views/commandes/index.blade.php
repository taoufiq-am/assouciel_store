@extends('layouts.admin')
@section('title', 'Gestion des categories')
@section('content')

    <h1>Liste des commandes</h1>
    <form action="{{ route('commandes.index') }}">
        <div>
            <label for="etat">Etat</label>
            <select name="etat" id="etat">
                <option value="">Select une etat</option>
                @foreach ($etats as $etat)
                    <option value="{{ $etat->id }}">{{ $etat->intitule }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Nom client</label>
            <input type="text" placeholder="nom de client" name="nomClient">
        </div>
        <div>
            <label for="">Date min</label>
            <input type="date" name="dateMin">
        </div>
        <div>
            <label for="">Date max</label>
            <input type="date" name="dateMax">
        </div>
        <input type="submit" value="Filtrer">
    </form>

    @if ($notFound)
        <h1>{{ $notFound }}</h1>
        <a href="{{ route('commandes.index') }}">go back to all commandes</a>
    @else
    <form action="{{ route('commandes.exportCSV') }}" method="post">
        @csrf
        <input type="submit" value="Export CSV file">
    </form>
    
    @endif



    <table class="table center  align-middle text-center caption-top">
        <thead>
            <tr>
                <th class="col ">ID</th>
                <th class="col ">etat</th>
                <th class="col ">date</th>
                <th class="col ">Nom client</th>
                <th class="col " colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commandes as $commande)
                <tr>
                    <td class="col ">{{ $commande->id }}</td>
                    <td class="col ">{{ $commande->etat->intitule }}</td>
                    <td class="col ">{{ $commande->created_at }}</td>
                    <td class="col ">{{ $commande->client->nom }}</td>
                    <td class="col ">
                        <form action="{{ route('commandes.show', ['commande' => $commande->id]) }}">
                            <input type="submit" name="" id="" value="detail">
                        </form>
                    </td>

                    <td class="col ">
                        <form action="{{ route('commandes.edit', ['commande' => $commande->id]) }}" method="get">
                            <input type="submit" name="" id="" value="modifier etat">
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div>
        {{ $commandes->links() }}
    </div>
@endsection
