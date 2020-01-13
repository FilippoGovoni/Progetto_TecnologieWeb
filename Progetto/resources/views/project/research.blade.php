@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Visualizza le ore spese per ogni progetto</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <?php $data = date('Y-m-d');?>
            <form action="{{ URL::action('ProjectController@ore_progetto') }}" method="GET">
                
                <div class="form-group">
                    <label for="data_inizio">Data di inizio</label>
                    <input class="form-control" type="date" name="data_inizio" value=<?php echo date('Y-m-01')?> />
                </div>
                <div class="form-group">
                    <label for="data_fine">Data di fine</label>
                    <input class="form-control" type="date" name="data_fine" value=<?php echo date("Y-m-t", strtotime($data))?> />
                </div>
                <div>
                    <input class="btn btn-primary" type="submit" value="Cerca">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')