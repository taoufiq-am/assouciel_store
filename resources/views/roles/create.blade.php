 @extends('layouts.layout')
 @section('title','Ajouter une role')
 @section('space-work')
 <div class="container">
     <h1>Créer une nouvelle role</h1>
     <form action="{{route('roles.store')}}" method="POST">
         @csrf
         <div>
         <label for="name">Name</label>
         <input type="text" name="name" id="name" value="{{old('name')}}">
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
