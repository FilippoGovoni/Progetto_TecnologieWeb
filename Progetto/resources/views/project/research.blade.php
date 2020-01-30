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
<style>
    #tipo {
        float: left;
        margin-left: 20px;
        padding-left: 20px;
    }

    #periodo {
        width: 25px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Ricerca</h1>
            <?php $data = date('Y-m-d'); ?>
            <form action="{{ URL::action('ProjectController@ore_progetto') }}" method="GET">

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span id="periodo" class="input-group-text">Periodo</span>
                    </div>
                    <input type="date" name="data_inizio" aria-label="data_inizio" class="form-control" value=<?php echo date('Y-m-01') ?>>
                    <input id="dat_fin" type="date" name="data_fine" aria-label="data_fine" class="form-control" value=<?php echo date("Y-m-t", strtotime($data)) ?>>

                </div><br>
                <span>
                        <select class="form-control" name="tipologia">
                            <option value="1">Visualizza il totale ore speso per ogni progetto</option>
                            <option value="2">Visualizza il totale ore speso per ogni cliente</option>
                        </select>
                    </span>
                <div><br>
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cerca</button>
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