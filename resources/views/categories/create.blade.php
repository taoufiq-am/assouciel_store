 @extends('layouts.layout')
 @section('title','Ajouter une categorie')
 @section('space-work')
 <div class="categorie">
     <h1>Créer une nouvelle categorie</h1>
     <form action="{{route('categories.store')}}" method="POST">
         @csrf
         <div>
         <label for="designation">Designation</label>
         <input type="text" name="designation" id="designation" value="{{old('designation')}}">
         </div>
          <div>
         <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10" >{{old('designation')}}</textarea>

         </div>
         <div>
             <input class="button" type="submit" value="Ajouter">
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
