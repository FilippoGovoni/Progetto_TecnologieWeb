@extends('layouts.app')

@section('content')
@auth
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dettagli del cliente</h1><br>
            <p>Ragione sociale: <b>{{ $elemento->ragione_sociale }}</b> </p>
            <p>Nome referente: <b>{{ $elemento->nome_referente }}</b>  </p>
            <p>Cognome referente: <b>{{ $elemento->cognome_referente }}</b>  </p>
            <p>Email referente: <b>{{ $elemento->Email_referente }}</b>  </p>
            <p>SSID: <b>{{ $elemento->SSID }}</b>  </p>
            <p>PEC: <b>{{ $elemento->PEC }}</b>  </p>
            <p>Partita IVA: <b>{{ $elemento->PIVA }}</b>  </p>

            <p>L'elemento è stato inserito il: <b> {{ date('d/m/Y', strtotime($elemento->created_at)) }}</b> </p>
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