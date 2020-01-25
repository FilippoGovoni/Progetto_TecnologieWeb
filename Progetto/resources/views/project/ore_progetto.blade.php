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
            <?php $data = date('Y-m-d'); ?>
            <form action="{{ URL::action('ProjectController@ore_progetto') }}" method="GET">
                <table id="table" class="table table-sm">
                    <tr class="table-info">
                        <td>
                            <input type="date" name="data_inizio" aria-label="data_inizio" class="form-control" value=<?php echo date('Y-m-01') ?>>
                        </td>
                        <td>
                            <input id="dat_fin" type="date" name="data_fine" aria-label="data_fine" class="form-control" value=<?php echo date("Y-m-t", strtotime($data)) ?>>
                        </td>
                        <td>
                            <select id="tipo" class="form-control" name="tipologia">
                            @if($tipologia==1)
                                <option value="1" selected>Progetti</option>
                                <option value="2">Clienti</option>
                            @else
                                <option value="1">Progetti</option>
                                <option value="2" selected>Clienti</option>
                            @endif
                            </select>
                        </td>
                        </td>
                        <td>
                            <button id="cerca" class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                        </td>
        </div>
        </tr>
        </table>



        </form>
    </div>
</div><br>
@if($tipologia==1)

<div class="row">
    <?php $totale = 0; ?>
    @if(count($schede_ore)>0)
    @foreach($progetti as $p)
    @foreach($schede_ore as $s)
    @if($s->project_id == $p->id)
    <?php $totale = $totale + $s->hours_work; ?>
    @endif
    @endforeach
    <div id="card1" class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header"><b>{{$p->name}}</b></div>
        <div class="card-body text-secondary">
            <h5 class="card-title">{{$p->description}}</h5>
            <p class="card-text">Totale ore spese sul progetto: <b>{{$totale}} ore</b></p>
            <p class="card-text">Stato del progetto: <b>
                @if($p->terminato==0)
                <span id="elaborazione">IN ELABORAZIONE</span>
                @else
                <span id="terminato">TERMINATO</span>
                @endif</b></p>
            <?php $totale= $totale*$p->costo_orario;?>
            <p class="card-text">Costo del progetto: <b>{{$totale}} €</b></p>
        </div>
    </div>
    <?php $totale = 0; ?>
    @endforeach
    @else
    Non sono state inserite schede_ore nel periodo selezionato
    @endif
</div>

@else
<?php $totale = 0; ?>
<div class="row">
    @foreach($clienti as $cliente)
    <div id="card2" class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header"><b>{{$cliente->nome_referente}} {{$cliente->PIVA}}</b></div>
        <div class="card-body text-secondary">
            @foreach($progetti as $p)
            @if($cliente->id == $p->client->id)
            @foreach($schede_ore as $s)
            @if($s->project_id == $p->id)
            <?php $totale = $totale + $s->hours_work; ?>
            @endif
            @endforeach
            @endif
            @endforeach
            <p class="card-text"> Totale ore spese sui progetti del cliente: <b>{{$totale}} ore</b></p>
        </div>
    </div>
    <?php $totale = 0; ?>
    @endforeach
</div>
@endif
</div>
@endauth
@guest 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    
                    <p>Effettua il login per accedere:  <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a> </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection