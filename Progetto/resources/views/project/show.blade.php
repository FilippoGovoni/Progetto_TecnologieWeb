@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dettagli del progetto</h1><br>
            <p>Nome: <b>{{ $elemento->name }}</b> </p>
            <p>Descrizione: <b>{{ $elemento->description }}</b> </p>
            <p>Note: <b>{{ $elemento->notes }}</b> </p>
            <p>Data_inizio: <b>{{ $elemento->data_inizio }}</b> </p>
            <p>data_fine: <b>{{ $elemento->data_fine }}</b> </p>
            <p>Cliente: <b>{{ $elemento->client->PIVA }}</b> </p><br>
            @if(count($utenti) > 0)
            <p>Utenti che lavorano al progetto: </p>
            <ul class="list-group">
            @foreach ($utenti as $user)    
                <li class="list-group-item">{{$user->user->name}} {{$user->user->surname}}</li>
            @endforeach    
            </ul>
            @else
            <p> Nessun utente è stato assegnato al progetto </p><br>
            <a href="{{ URL::action('ProjectController@edit', $elemento->id) }}" class="btn btn-secondary btn-sm"> Assegna </a>
            @endif
            
        </div>
    </div>
</div>
@endsection