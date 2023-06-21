<!DOCTYPE html>
<html lang="fr ">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>@yield("title")</title>
</head>
<body>
    <!-- nom de la route -->
    @php
    use Illuminate\Support\Facades\Auth;
        $routeName = request()->route()->getName();
    @endphp

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- @class dinamique-->
                    <!-- la class nav-link est active si la route commmence par '.blog' -->
                <a
                @class (['nav-link', 'active' => str_starts_with($routeName, 'blog.')]) 
                aria-current="page" href="{{ route ('blog.index')}}">Blog</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            <div class="navbar-nav  ms-auto mb-2 mb-lg-0">
                <!-- si le utilisateur est connecté affiche le nom -->
                @auth 
                    {{ Auth::user()->name }}
                    <form class="nav-item" action="{{ route('auth.logout') }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="nav-item mx-3">Se déconnecter</button>
                    </form>
               @endauth
                <!-- button pour se connecter  -->
                @guest 
                <div class="nav-item">
                    <a href="{{ route('auth.login') }}" class="nav-item">Se connecter</a>
                </div>
                @endguest
            </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- message d'alert  success dans session -->
        @if (session ('success'))
            <div class="alert alert-success">
                {{ session("success") }}
            </div>
        @endif
        @yield("content")
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>