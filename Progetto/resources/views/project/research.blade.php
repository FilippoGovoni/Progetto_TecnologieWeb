@extends('layouts.app')

@section('content')
<style>
    #tipo {
        float: left;
        margin-left: 20px;
        padding-left: 20px;
    }

    #periodo {
        width: 25px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Ricerca</h1>
            <?php $data = date('Y-m-d'); ?>
            <form action="{{ URL::action('ProjectController@ore_progetto') }}" method="GET">

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span id="periodo" class="input-group-text">Periodo</span>
                    </div>
                    <input type="date" name="data_inizio" aria-label="data_inizio" class="form-control" value=<?php echo date('Y-m-01') ?>>
                    <input id="dat_fin" type="date" name="data_fine" aria-label="data_fine" class="form-control" value=<?php echo date("Y-m-t", strtotime($data)) ?>>

                </div><br>
                <span>
                        <select id="tipo" class="form-control" name="tipologia">
                            <option value="1">Visualizza il totale ore speso per ogni progetto</option>
                            <option value="2">Visualizza il totale ore speso per ogni cliente</option>
                        </select>
                    </span>
                <div><br>
                    <input id="ok" class="btn btn-primary" type="submit" value="Cerca">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')