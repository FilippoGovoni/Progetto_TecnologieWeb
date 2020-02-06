<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    @yield('link')
</head>

<body>
    <?php $month=date('n'); ?>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ URL::action('ProjectController@visualizza','2') }}">
                <i class="fas fa-project-diagram"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Route::has('login'))
                        @auth
                        @if(Auth::user()->role == 1)
                        <li class="nav-item dropdown bg-dark">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Utenti
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ URL::action('AdminController@index') }}"><i class="fas fa-list-ul"></i> Mostra Utenti</a>
                                <a class="dropdown-item" href="{{ URL::action('AdminController@create') }}"><i class="fas fa-user-plus"></i> Inserisci Utenti</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Clienti
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ URL::action('ClientController@index') }}"><i class="fas fa-list-ul"></i> Mostra Clienti</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Progetti
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ URL::action('ProjectController@visualizza',2) }}"><i class="fas fa-list-ul"></i> Mostra Progetti</a>
                                <a class="dropdown-item" href="{{ URL::action('ProjectController@create') }}"><i class="fas fa-folder-plus"></i> Inserisci Progetti</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navBarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Scheda Ore
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ URL::action('SchedaoreController@att_mensile',$month) }}"><i class="fas fa-list-ul"></i> Visualizza attività</a>
                                <a class="dropdown-item" href="{{ URL::action('SchedaoreController@create') }}"><i class="fas fa-folder-plus"></i> Inserisci una nuova Scheda Ore</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{URL::action('ProjectController@research')}}">Visualizza statistiche ore</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::action('SchedaoreController@att_mensile',$month) }}">Visualizza attività</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navBarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Scheda Ore
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ URL::action('SchedaoreController@index') }}"><i class="fas fa-list-ul"></i> Visualizza le tue schede Ore</a>
                                <a class="dropdown-item" href="{{ URL::action('SchedaoreController@create') }}"><i class="fas fa-folder-plus"></i> Inserisci una nuova Scheda Ore</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::action('ProjectController@visualizza','2') }}"><i class="fas fa-list-ul"></i> Riepilogo Progetti</a>
                        </li>
                        @endif
                        @endauth
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>