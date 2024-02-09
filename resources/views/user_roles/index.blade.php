@extends('layouts.layout')
@section('title','Permissions')
@section('space-work')
    <div class="container">
        {{-- <div class="d-flex justify-content-between my-3">
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Ajouter une nouvelle categorie</a>
        </div> --}}
         <table id="tbl" class="table center  align-middle text-center caption-top">
            <tr>
                <th>User</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            @if (isset($notFound))
            <tr>
               <td colspan="6">La list est vide <a href="{{ route("roles.index") }}">Retourner a la list</a></td>
            </tr>
            @else
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name }},
                        @endforeach
                    </td>
                    <td><a class="btn btn-success" href="{{ route('user_roles.create', ['user' => $user->id]) }}">Assign Role</a></td>
                </tr>
            @endforeach
        </table>
        {{-- <div>
            {{ $roles->links() }}
        </div> --}}
        @endif
    </div>
@endsection
