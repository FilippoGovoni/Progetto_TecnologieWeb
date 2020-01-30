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
        <div class="col-md-12">
            <h1>Dettagli del progetto</h1><br>
            <p>Nome: <b>{{ $elemento->name }}</b> </p>
            <p>Descrizione: <b>{{ $elemento->description }}</b> </p>
            <p>Note: <b>{{ $elemento->notes }}</b> </p>
            <p>Data di inizio: <b>{{ date('d-m-yy', strtotime($elemento->data_inizio)) }}</b> </p>
            <p>Data di fine: <b>{{ date('d-m-yy', strtotime($elemento->data_fine)) }}</b> </p>
            <p>Cliente: <b>{{ $elemento->client->PIVA }}</b> </p><br>
            <?php $totale = 0; ?>
            @foreach ($utenti as $user)
            @foreach($schede as $s)
            @if(($s->project_id == $elemento->id) && ($s->user_id == $user->user_id))
            <?php $totale = $totale + $s->hours_work; ?>
            @endif
            @endforeach
            @endforeach
            @if($elemento->terminato==1) <div class="progress">
                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            @else
            @if($totale < 30) <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        @endif
        @if(($totale >= 30) && ($totale < 55)) <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    @endif
    @if(($totale >= 55) && ($totale < 75)) <div class="progress">
        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>
@endif
@if($totale >= 75) <div class="progress">
    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
</div>
@endif
@endif
<br><br>
@if(count($utenti) > 0)
@if($elemento->terminato==1)
<p>Utenti che hanno lavorato al progetto: </p>
@else
<p>Utenti che lavorano al progetto: </p>
@endif
<table class="table table-sm">
    <ul class="list-group">
        @foreach ($utenti as $user)
        <tr>
            <td>{{$user->user->name}} {{$user->user->surname}}</td>

            <?php $totale = 0; ?>

            @foreach($schede as $s)
            @if(($s->project_id == $elemento->id) && ($s->user_id == $user->user_id))
            <?php $totale = $totale + $s->hours_work; ?>
            @endif
            @endforeach
            <td>Totale ore lavorate dall'utente: <b>{{ $totale }}</b></td>
            @if($elemento->terminato==0)
            <td>
                @csrf
                <a href="{{ URL::action('ProjectController@elimina_user_assegnato', [$elemento->id,$user->user->id]) }}" class="btn btn-danger btn-sm"> <i class="fas fa-user-times"></i> </a>
            </td>
            @endif

        </tr>
        @endforeach

    </ul>
    @else
    <tr>
        <td>
            <p> <b>Nessun utente è stato assegnato al progetto</b> </p><br>
        </td>
    <tr>
    <tr>
        <td><a href="{{ URL::action('ProjectController@assegna', $elemento->id) }}" class="btn btn-secondary btn-sm"> Assegna </a></td>
    <tr>
        @endif
        @if($elemento->terminato==0)
        <tfoot>
            <tr>
                <td>
                    <a href="{{ URL::action('ProjectController@assegna', $elemento->id) }}" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> Assegna un altro utente</a>
                </td>
            </tr>
        </tfoot>
        @endif
</table>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary float-md-right" href="{{ URL::action('ProjectController@visualizza',2) }}">Torna a Progetti</a>
    </div>
</div>
</div>
@endauth
@guest
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Good Try</strong> Devi effettuare il login per accedere al contenuto: <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection