 @extends('layouts.layout')
 @section('title', 'Modifier une role')
 @section('space-work')
<div class="container">

    <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <h3 class="text-center">Modifier la role N° {{ $role->id }}</h3>
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}">
        </div>
        <div>
            <input class="btn btn-primary" type="submit" value="Modifier">
        </div>
    </form>
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $er)
                    <li>{{ $er }}</li>
                @endforeach
            </ul>



        @endif
    </div>
</div>
@endsection
