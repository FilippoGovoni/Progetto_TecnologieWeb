@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Assegna il progetto ad un Utente</h1><br>

            <form action="{{ URL::action('ProjectController@update', $project->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <h5>Progetto selezionato: </h5>
               <p>Nome: {{$project->name}}</p>
               <p>Descrizione: {{$project->description}}</p><br>
               <div class="form-group">
                    <label for="user_id">Seleziona l'utente a cui assegnarlo</label>
                    <select class="form-control" name="user_id">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                        @endforeach
                    </select>
                </div>

                <input class="btn btn-primary" type="submit" value="Assegna">
            </form>
        </div>
    </div>
@endsection