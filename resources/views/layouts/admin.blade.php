<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include the noUiSlider stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">


    <title>@yield('title', 'App store')</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="{{ route('home.index') }}">Accueil</a></li>
            <li><a href="{{ route('categories.index') }}">Gestion des categories</a></li>
            <li><a href="{{ route('produits.index') }}">Gestion des produits</a></li>
            <li><a href="#">Gestion des commande</a></li>
            <li><a href="{{route("home.show")}}">View cart</a></li>
            <li><a href="#">mes commande</a></li>
        </ul>
    </nav>
    <div class="main">
        @yield('content')
    </div>
    <footer>
        &copy;OFPPT 2024
    </footer>
    <!-- Include the noUiSlider JavaScript library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
<script src="{{asset("js/main.js")}}"></script>
</body>

</html>
