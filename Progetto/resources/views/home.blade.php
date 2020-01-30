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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    
                    <p><b>Hai effettuato l'accesso</b></p>
                    
                </div>
            </div>
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
@endsection
