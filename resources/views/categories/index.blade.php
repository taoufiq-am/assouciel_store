 @extends('layouts.layout')
 @section('title', 'Gestion des categories')
 @section('space-work')

     <h1>Liste des categories</h1>
     {{-- <form action="{{ route('categories.search') }}" method="get">
         <div>
             <label for="designation">Designation : </label>
             <input type="text" id="designation" name="designation" placeholder="Filtrer par designation"
                 value="{{ $params['designation'] }}">
         </div>
         <div>
             <label for="description">Description : </label>
             <input type="text" id="description" name="description" placeholder="Filtrer par description"
                 value="{{ $params['description'] }}">
         </div>
         <div>
             <input type="submit" value="Appliquer" id="submitFilter">
         </div>
     </form> --}}
     <form class="form-inline" action="{{ route('categories.search') }}" method="get">
        <div class="form-group mx-sm-3 mb-2">
           <label for="designation" class="text-dark mr-2" style="font-size: 1.25em">Designation :</label>
          <input type="text" class="form-control border " id="designation" name="designation" placeholder="Designation" value="{{ $params['designation'] }}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
          <label for="description" class="text-dark mr-2" style="font-size: 1.25em">Description :</label>
          <input type="text" class="form-control border" id="description" name="description" placeholder="Description" value="{{ $params['description'] }}">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Filter</button>
      </form>
     <div class="d-flex justify-content-between my-3">
         <a href="{{ route('categories.create') }}" class="btn btn-primary">Ajouter une nouvelle categorie</a>
         <a href="{{ route('categories.clear') }}" class="btn btn-danger">Supprimer tous les categories</a>
     </div>
     <table id="tbl" class="table center  align-middle text-center caption-top">
         <tr>
             <th>Id</th>
             <th>Designation</th>
             <th>Description</th>
             <th colspan="3">Actions</th>
         </tr>
         @if (isset($notFound))
         <tr>
            <td colspan="6">La list est vide <a href="{{ route("categories.index") }}">Retourner a la list</a></td>
         </tr>
         @else
         @foreach ($categories as $cat)
             <tr>
                 <td>{{ $cat->id }}</td>
                 <td>{{ $cat->designation }}</td>
                 <td>{{ $cat->description }}</td>
                 <td><a class="btn btn-secondary" href="{{ route('categories.show', ['category' => $cat->id]) }}">Details</a></td>
                 <td><a class="btn btn-success" href="{{ route('categories.edit', ['category' => $cat->id]) }}">Modifier</a></td>
                 <td>
                     <form action="{{ route('categories.destroy', ['category' => $cat->id]) }}" method="POST">
                         @method('DELETE')
                         @csrf
                         <input class="btn btn-danger" type="submit" value="Supprimer"
                             onclick="return confirm('voulez-vous supprimer cette categorie?')">
                     </form>
                 </td>
             </tr>
         @endforeach
     </table>
     <div>
         {{ $categories->links() }}
     </div>
     @endif
 @endsection
