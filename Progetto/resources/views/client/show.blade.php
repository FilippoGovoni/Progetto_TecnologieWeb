@extends('layouts.app')

@section('content')
@auth
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dettagli del cliente</h1><br>
            <p>Ragione sociale: {{ $elemento->ragione_sociale }} </p>
            <p>Nome referente: {{ $elemento->nome_referente }} </p>
            <p>Cognome referente: {{ $elemento->cognome_referente }} </p>
            <p>Email referente: {{ $elemento->Email_referente }} </p>
            <p>SSID: {{ $elemento->SSID }} </p>
            <p>PEC: {{ $elemento->PEC }} </p>
            <p>Partita IVA: {{ $elemento->PIVA }} </p>

            <p>L'elemento è stato inserito il: {{ date('d/m/Y', strtotime($elemento->created_at)) }}</p>
        </div>
    </div>
    <div class="row">
        <a href="{{ URL::action('ClientController@edit', $elemento->id) }}"> <button type="button" class="btn btn-primary">Modifica</button> </a>
        <a href="{{ URL::action('ClientController@destroy', $elemento->id) }}"> <button type="button" class="btn btn-danger">Cancella</button> </a>
    </div>
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