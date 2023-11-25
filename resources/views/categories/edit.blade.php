 @extends('layouts.admin')
 @section('title', 'Modifier une categorie')
 @section('content')
         <h1>Modifier la categorie num {{ $cat->id }}</h1>
         <form action="{{ route('categories.update', ['category' => $cat->id]) }}" method="POST">
             @csrf
             @method('PUT')
             <div>
                 <label for="designation">Designation</label>
                 <input type="text" name="designation" id="designation" value="{{ old('designation', $cat->designation) }}">
             </div>
             <div>
                 <label for="description">Description</label>
                 <textarea name="description" id="description" cols="30" rows="10">{{ old('designation', $cat->description) }}</textarea>

             </div>
             <div>
                 <input type="submit" value="Modifier">
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
@endsection
