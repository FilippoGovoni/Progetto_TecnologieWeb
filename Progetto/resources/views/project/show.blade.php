@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dettagli del progetto</h1><br>
            <p>Nome: <b>{{ $elemento->name }}</b> </p>
            <p>Descrizione: <b>{{ $elemento->description }}</b> </p>
            <p>Note: <b>{{ $elemento->notes }}</b> </p>
            <p>Data_inizio: <b>{{ date('d-m-yy', strtotime($elemento->data_inizio)) }}</b> </p>
            <p>data_fine: <b>{{ date('d-m-yy', strtotime($elemento->data_fine)) }}</b> </p>
            <p>Cliente: <b>{{ $elemento->client->PIVA }}</b> </p><br>
            @if(count($utenti) > 0)
            <p>Utenti che lavorano al progetto: </p>
            <table class="table table-sm table-dark">
                <ul class="list-group">
                    @foreach ($utenti as $user)
                    <tr>
                        <td >{{$user->user->name}} {{$user->user->surname}}</td>
                        <td><a href="{{ URL::action('ProjectController@elimina_user_assegnato', [$elemento->id,$user->id]) }}" class="btn btn-danger btn-sm"> X </a></td>
                    </tr>
                    @endforeach

                </ul>
                @else
                <tr>
                    <td>
                        <p> Nessun utente è stato assegnato al progetto </p><br>
                    </td>
                <tr>
                <tr>
                    <td><a href="{{ URL::action('ProjectController@assegna', $elemento->id) }}" class="btn btn-secondary btn-sm"> Assegna </a></td>
                <tr>
                    @endif
            </table>
        </div>
    </div>
</div>
@endsection