 @extends('layouts.layout')
 @section('title', 'Modifier une categorie')
 @section('space-work')
<div class="categorie">

    <form action="{{ route('categories.update', ['category' => $cat->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <h3 class="text-center">Modifier la categorie N° {{ $cat->id }}</h3>
        <div>
            <label for="designation">Designation</label>
            <input type="text" name="designation" id="designation" value="{{ old('designation', $cat->designation) }}">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('designation', $cat->description) }}</textarea>

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
