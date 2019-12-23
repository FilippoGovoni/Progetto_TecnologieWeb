@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dettagli del cliente</h1>
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
</div>
<a href="{{ URL::action('ClientController@edit', $elemento->id) }}"> <button type="button" class="btn btn-primary">Modifica</button> </a>
<button type="button" class="btn btn-danger">Cancella</button>
@endsection