<!doctype html>
<html lang="en">
  <head>
  	<title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/multiselect-dropdown.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
    @vite('resources/js/app.js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
      .multiselect-dropdown{
        width:100% !important;
      }
    </style>
  </head>
  <body>
      <div class="wrapper d-flex align-items-stretch">
           @if (Auth::user())
             <nav id="sidebar">
                 <div class="custom-menu">
                     <button type="button" id="sidebarCollapse" class="btn btn-primary">
               <i class="fa fa-bars"></i>
               <span class="sr-only">Toggle Menu</span>
             </button>
         </div>
               <h1><a href="" class="logo">Admin Dashboard</a></h1>
            <ul class="list-unstyled components mb-5">

             {{-- <li>
                 <a href="/logout"><span class="fa fa-sign-out mr-3"></span> Logout</a>
             </li> --}}
             @if (Auth::user()->hasRole('Admin'))
             <li><a href="{{ route('register') }}">Ajouter un admin </a></li>
             <li><a href="{{ route('roles.index') }}">Gestion des roles </a></li>
             <li><a href="{{ route('permissions.index') }}">Gestion des permissions </a></li>
             <li><a href="{{ route('user_roles.index') }}">Gestion des admins </a></li>
             @endif
             @if (Auth::user()->hasRole('commercial'))
             <li><a href="{{ route('commandes.index') }}">Gestion des commandes</a></li>
             @endif
             @if (Auth::user()->hasRole('magasinier'))
             <li><a href="{{ route('categories.index') }}">Gestion des categories</a></li>
             <li><a href="{{ route('produits.index') }}">Gestion des produits</a></li>
             @endif

             <li>
                 <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <input type="submit" value="Log out">
                 </form>
             </li>
         </ul>

         </nav>
       @endif

    <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('space-work')
        </div>
    </div>



    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mainn.js') }}"></script>
  </body>
</html>
