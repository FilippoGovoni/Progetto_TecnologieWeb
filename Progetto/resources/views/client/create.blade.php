@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Inserisci un nuovo cliente</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ URL::action('ClientController@store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="ragione_sociale">Ragione Sociale</label>
                    <input class="form-control" type="text" name="ragione_sociale" />
                </div>
                <div class="form-group">
                    <label for="nome_referente">Nome referente </label>
                    <input class="form-control" type="text" name="nome_referente" />
                </div>
                <div class="form-group">
                    <label for="cognome_referente">Cognome referente</label>
                    <input class="form-control" type="text" name="cognome_referente" />
                </div>
                <div class="form-group">
                    <label for="Email_referente">Email referente </label>
                    <input class="form-control" type="text" name="Email_referente" />
                </div>
                <div class="form-group">
                    <label for="SSID">Inserisci il codice SSID </label>
                    <input class="form-control" type="text" name="SSID" />
                </div>
                <div class="form-group">
                    <label for="PEC">Inserisci il codice PEC </label>
                    <input class="form-control" type="text" name="PEC" />
                </div>
                <div class="form-group">
                    <label for="PIVA">Inserisci la partita IVA </label>
                    <input class="form-control" type="text" name="PIVA" />
                </div>


                <div>
                    <input class="btn btn-primary" type="submit" value="Invia">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')