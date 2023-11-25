 @extends('layouts.admin')
 @section('title','Gestion des categories')
 @section('content')
     
    <h1>Liste des categories</h1>
    <form  action="{{route("categories.search")}}" method="get">
      <label for="chercher">chercher</label>
      <input type="text" id="chercher" name="val_search">
      <input type="submit" value="Chercher">
    </form>
    <a href="{{route('categories.create')}}">Ajouter une nouvelle categorie</a>
    <table id="tbl">
      <tr>
        <th>Id</th>
        <th>Designation</th>
        <th>Description</th>
        <th colspan="3">Actions</th>
      </tr>
      @foreach ($categories as $cat)
          <tr>
            <td>{{$cat->id}}</td>
            <td>{{$cat->designation}}</td>
            <td>{{$cat->description}}</td>
            <td><a href="{{route('categories.show',["category"=>$cat->id])}}">Details</a></td>
            <td><a href="{{route('categories.edit',["category"=>$cat->id])}}">Modifier</a></td>
            <td>
                <form action="{{route('categories.destroy',["category"=>$cat->id])}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Supprimer" onclick="return confirm('voulez-vous supprimer cette categorie?')">
                </form></td>
          </tr>
      @endforeach
    </table>
 @endsection