 @extends('layouts.admin')
 @section('title','Detail d \'une categorie')
 @section('content')
    <a href="{{route('categories.index')}}">Retourner vers la liste des categories</a>
    <h1>Detail de la categorie Num {{$cat->id}}</h1>
    <div>
        <p><strong>Designation:</strong> {{$cat->designation}}</p>
        <p><strong>Description:</strong> {{$cat->description}}</p>
    </div>
@endsection