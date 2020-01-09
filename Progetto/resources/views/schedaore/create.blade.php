@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-6">
        <h1>Nuova Scheda Ore</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($elements->all()>0)
        <form action="{{ URL::action('SchedaoreController@store') }}" method="POST">
            {{ csrf_field()}}

            <div class="form-group">
                <label for="data_scheda">Data Della Scheda</label>
                <input class="form-control" type="date" name="data_scheda" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>"/>
            </div>

            <div class="form-group">
                <label for="project_name">Progetto</label>
                <select class="form-control" name="project_name">
                    @foreach ($elements as $project)
                    @if( $project->user_id == Auth::user()->id)
                    <option value="{{ $project->project->name }}">{{ $project->project->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hours_work">Numero di ore</label>                        
                <input class="form-control" type="number" name="hours_work" />
            </div>

            <div class="form-group">
                <label for="note">Note</label>
                <textarea name="note" cols="50" rows="5"></textarea>
            </div>

            <input type="hidden" name="user_id" value="{{ Auth::user()->id  }}">
                


            <input class="btn btn-primary" type="submit" value="Conferma scheda ore">

        </form>
        @else
            <h1>NON SONO ANCORA STATI ASSEGNATI PROGETTI</h1>
        @endif
    </div>
</div>

@endsection('content')