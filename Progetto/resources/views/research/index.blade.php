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

            <form action="{{ URL::action('ResearchController@store') }}" method="POST">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="data_inizio">Data di inizio</label>
                    <input class="form-control" type="date" name="data_inizio" />
                </div>
                <div class="form-group">
                    <label for="data_fine">Data di fine</label>
                    <input class="form-control" type="date" name="data_fine" />
                </div>
                <div>
                    <input class="btn btn-primary" type="submit" value="Cerca">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')