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
            <p>Cliente: <a href="javascript:autoPopup()"><b>{{ $elemento->client->nome_referente }} {{ $elemento->client->cognome_referente }} {{ $elemento->client->PIVA }}</b></a>
            </p><br>
            <?php $totale = 0; ?>
            @foreach ($utenti as $user)
            @foreach($schede as $s)
            @if(($s->project_id == $elemento->id) && ($s->user_id == $user->user_id))
            <?php $totale = $totale + $s->hours_work; ?>
            @endif
            @endforeach
            @endforeach
            @if($totale!=0)
            @if($elemento->terminato==1) <div class="progress">
                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            @else
            @if($totale < 30) <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $totale }}%" aria-valuenow="{{ $totale }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        @endif
        @if(($totale >= 30) && ($totale < 55)) <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $totale }}%" aria-valuenow="{{ $totale }}" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    @endif
    @if(($totale >= 55) && ($totale < 75)) <div class="progress">
        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: {{ $totale }}%" aria-valuenow="{{ $totale }}" aria-valuemin="0" aria-valuemax="100"></div>
</div>
@endif
@if($totale >= 75) <div class="progress">
    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{ $totale }}%" aria-valuenow="{{ $totale }}" aria-valuemin="0" aria-valuemax="100"></div>
</div>
@endif
@endif
@else  <div class="progress">
         <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{ $totale }}%" aria-valuenow="{{ $totale }}" aria-valuemin="0" aria-valuemax="100"></div>
</div>
@endif
<br><br>
@if(Auth::user()->role==1)
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
        @endif
        @if($elemento->terminato==0)
        <tfoot>
            <tr>
                <td>
                    <a href="{{ URL::action('ProjectController@assegna', $elemento->id) }}" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> Assegna un nuovo utente</a>
                </td>
            </tr>
        </tfoot>
        @endif
</table>
@endif
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary float-md-right" href="{{ URL::action('ProjectController@visualizza',2) }}">Torna a Progetti</a>
    </div>
</div>
</div>
<script type="text/javascript">
    function autoPopup() {
        var stili = "top=70, left=600, width=400, height=500, status=no, menubar=no, toolbar=no scrollbars=yes";
        var testo = window.open("", "", stili);
        testo.document.write("<html>");
        testo.document.write(" <head>");
        testo.document.write("<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>");
        testo.document.write(" <title>Cliente</title>");
        testo.document.write(" </head>");
        testo.document.write("<body topmargin=5>");
        testo.document.write("<div class='card' style='width: 18rem;'>");
        testo.document.write("<i class='fas fa-user'></i>");
        testo.document.write("<div class='card-body'>");
        testo.document.write("<h4 class='card-title'>Scheda Cliente</h4>");
        testo.document.write("</div>");
        testo.document.write("<ul class='list-group list-group-flush'>");
        testo.document.write("<li class='list-group-item'>{{$elemento->client->ragione_sociale}}</li>");
        testo.document.write("<li class='list-group-item'>{{$elemento->client->nome_referente}}</li>");
        testo.document.write("<li class='list-group-item'>{{$elemento->client->cognome_referente}}</li>");
        testo.document.write("<li class='list-group-item'>{{$elemento->client->Email_referente}}</li>");
        testo.document.write("<li class='list-group-item'>SSID: {{$elemento->client->SSID}}</li>");
        testo.document.write("<li class='list-group-item'>PEC: {{$elemento->client->PEC}}</li>");
        testo.document.write("<li class='list-group-item'>Partita IVA: {{$elemento->client->PIVA}}</li>");
        testo.document.write("</div>");
        testo.document.write("</body>");
        testo.document.write("</html>");
    }
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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