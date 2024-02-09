@extends('layouts.layout')
@section('title','Ajouter une role')
@section('space-work')
<div class="container">
    <h1>Créer une nouvelle role</h1>
    <form action="{{route('user_roles.store', ['user' => $user->id])}}" method="POST">
        @csrf
        <div>
        <label for="name">User:</label>
        <input type="text" name="name" id="name" value="{{$user->name}}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5>Roles disponibles</h5>
                <ul>
                    @foreach ($roles as $role)
                        @if (!$user->hasRole($role->name))
                            <li>
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Roles assignées</h5>
                <ul>
                    @foreach ($roles as $role)
                        @if ($user->hasRole($role->name))
                            <li>
                                <label>
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" checked>
                                    {{ $role->name }}
                                </label>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div>
            <input class="button" type="submit" value="Assign">
        </div>
    </form>
    <div>
        @if($errors->any())
        <ul>
          @foreach($errors->all() as $er)
           <li>{{$er}}</li>

           @endforeach
        </ul>



        @endif
    </div>
</div>
@endsection
