@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Modifica il cliente</h1>
            <form action="{{ URL::action('ClientController@update', $client->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="ragione_sociale">Ragione sociale</label>                        
                    <input class="form-control" type="text" name="ragione_sociale" value="{{ $client->ragione_sociale }}" />
                </div>
                <div class="form-group">
                    <label for="nome_referente">Nome referente</label>
                    <input class="form-control" type="text" name="nome_referente" value="{{ $client->nome_referente }}"/>
                </div>
                <div class="form-group">
                    <label for="cognome_referente">Cognome referente</label>
                    <input class="form-control" type="text" name="cognome_referente" value="{{ $client->cognome_referente }}"/>
                </div>
                <div class="form-group">
                    <label for="Email_referente">Email referente</label>
                    <input class="form-control" type="text" name="Email_referente" value="{{ $client->Email_referente }}"/>
                </div>
                <div class="form-group">
                    <label for="SSID">SSID</label>
                    <input class="form-control" type="text" name="SSID" value="{{ $client->SSID }}"/>
                </div>
                <div class="form-group">
                    <label for="PEC">PEC</label>
                    <input class="form-control" type="text" name="PEC" value="{{ $client->PEC }}"/>
                </div>
                <div class="form-group">
                    <label for="PIVA">PIVA</label>
                    <input class="form-control" type="text" name="PIVA" value="{{ $client->PIVA }}"/>
                </div>


                <input class="btn btn-primary" type="submit" value="Aggiorna">
            </form>
        </div>
    </div>
@endsection