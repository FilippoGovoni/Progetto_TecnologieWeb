@extends('layouts.app')
@section('link')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<!--Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- Icone -->
<script src="https://kit.fontawesome.com/a697c89225.js" crossorigin="anonymous"></script>
<!-- JQuery -->
<script type="text/javascript" src="../assets/js/jquery-3.2.0.min.js"></script>
@endsection
@section('content')

@auth
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Modifica i tuoi dati</h1>
            <br>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ URL::action('AdminController@update',Auth::user()->id) }}" method="POST">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nome e Cognome</span>
                    </div>
                    <input type="text" name="name" aria-label="First name" class="form-control" value="{{ $user->name}}">
                    <input type="text" name="surname" aria-label="Last name" class="form-control" value="{{ $user->surname}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>
                    <input type="text" name="email" class="form-control" placeholder=" " aria-label="email" aria-describedby="basic-addon1" value="{{ $user->email}}">
                </div>

                <div>
                    <input id="ok" class="btn btn-primary" type="submit" value="Invia">
                </div>
            </form>
        </div>
    </div>
</div>

@endauth
@guest
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Good Try</strong> Devi effettuare il login per accedere al contenuto: <a class="btn btn-warning" href="{{ route('login') }}">{{ __('Login') }}</a> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection('content')