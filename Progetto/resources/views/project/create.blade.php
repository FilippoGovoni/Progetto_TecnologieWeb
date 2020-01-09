@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Crea un nuovo Progetto</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ URL::action('ProjectController@store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input class="form-control" type="text" name="name" />
                </div>
                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <input class="form-control" type="text" name="description" />
                </div>
                <div class="form-group">
                    <label for="notes">Note</label>
                    <input class="form-control" type="text" name="notes" />
                </div>
                <div class="form-group">
                    <label for="data_inizio">Data di inizio</label>
                    <input class="form-control" type="date" name="data_inizio" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"/>
                </div>
                <div class="form-group">
                    <label for="data_inizio">Data di fine</label>
                    <input class="form-control" type="date" name="data_fine" />
                </div>
                <div class="form-group">
                    <label for="costo_orario">Costo orario</label>
                    <input class="form-control" type="number" name="costo_orario" />
                </div>
                <div class="form-group">
                    <label for="client_id">Cliente</label>
                    <select class="form-control" name="client_id">
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nome_referente }} {{ $client->cognome_referente }} {{ $client->PIVA }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input class="btn btn-primary" type="submit" value="Invia">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')