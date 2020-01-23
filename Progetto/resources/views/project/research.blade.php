@extends('layouts.app')

@section('content')
@auth
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
                        <select class="form-control" name="tipologia">
                            <option value="1">Visualizza il totale ore speso per ogni progetto</option>
                            <option value="2">Visualizza il totale ore speso per ogni cliente</option>
                        </select>
                    </span>
                <div><br>
                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cerca</button>
                </div>
            </form>
        </div>
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
@endsection('content')