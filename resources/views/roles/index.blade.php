@extends('layouts.layout')
@section('title','Permissions')
@section('space-work')
    <div class="container">
        <div class="d-flex justify-content-between my-3">
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Ajouter une nouvelle categorie</a>
        </div>
         <table id="tbl" class="table center  align-middle text-center caption-top">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
            @if (isset($notFound))
            <tr>
               <td colspan="6">La list est vide <a href="{{ route("roles.index") }}">Retourner a la list</a></td>
            </tr>
            @else
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td><a class="btn btn-success" href="{{ route('roles.edit', ['role' => $role->id]) }}">Modifier</a></td>
                    <td><a class="btn btn-success" href="{{ route('roles.show', ['role' => $role->id]) }}">give premission</a></td>
                    <td>
                        <form action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Supprimer"
                                onclick="return confirm('voulez-vous supprimer cette role?')">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{-- <div>
            {{ $roles->links() }}
        </div> --}}
        @endif
    </div>
@endsection
