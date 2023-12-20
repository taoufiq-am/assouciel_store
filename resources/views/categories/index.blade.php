 @extends('layouts.admin')
 @section('title', 'Gestion des categories')
 @section('content')

     <h1>Liste des categories</h1>
     <form action="{{ route('categories.search') }}" method="get">
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
             <input type="submit" value="Appliquer" id="submitFilter" disabled>
         </div>
     </form>
     <a href="{{ route('categories.create') }}">Ajouter une nouvelle categorie</a>
     <a href="{{ route('categories.clear') }}">Supprimer tous les categories</a>
     @if (isset($notFound))
         <h3>{{ $notFound }} <a href="{{ route('categories.index') }}">retournez a la liste principale</a></h3>
     @endif

     <table id="tbl" class="table center  align-middle text-center caption-top">
         <tr>
             <th>Id</th>
             <th>Designation</th>
             <th>Description</th>
             <th colspan="3">Actions</th>
         </tr>
         @foreach ($categories as $cat)
             <tr>
                 <td>{{ $cat->id }}</td>
                 <td>{{ $cat->designation }}</td>
                 <td>{{ $cat->description }}</td>
                 <td><a href="{{ route('categories.show', ['category' => $cat->id]) }}">Details</a></td>
                 <td><a href="{{ route('categories.edit', ['category' => $cat->id]) }}">Modifier</a></td>
                 <td>
                     <form action="{{ route('categories.destroy', ['category' => $cat->id]) }}" method="POST">
                         @method('DELETE')
                         @csrf
                         <input type="submit" value="Supprimer"
                             onclick="return confirm('voulez-vous supprimer cette categorie?')">
                     </form>
                 </td>
             </tr>
         @endforeach
     </table>
     <div>
         {{ $categories->links() }}
     </div>
 @endsection
