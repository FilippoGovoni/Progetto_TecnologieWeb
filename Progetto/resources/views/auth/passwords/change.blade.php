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

<div class="container">
    <h2> Cambia Password </h2><br>
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="row">
        <form action="{{ URL::action('ChangePasswordController@cambia_password')}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" name="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1">
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" value="" />
            </div>
            <div class="form-group">
                <label for="password">Ripeti Password</label>
                <input class="form-control" type="password" name="password_di_controllo" value="" />
            </div>


            <input class="btn btn-primary" type="submit" value="Cambia Password">
        </form>
    </div>
</div>
</div>
@endsection