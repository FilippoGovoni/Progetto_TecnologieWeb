@extends('layouts.app')

@section('content')
@auth
    <div class="row">
        <div class="col-md-6">
            <h1>Assegna il progetto ad un Utente</h1><br>

            <form action="{{ URL::action('ProjectController@update', $project->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <h5>Progetto selezionato: </h5>
               <p>Nome: <b>{{$project->name}}</b></p>
               <p>Descrizione: <b>{{$project->description}}</b></p><br>
               <?php $i=0;
                     $j=0; ?>
               <div class="form-group">
               <label for="user_id">Seleziona l'utente a cui assegnarlo</label>
                    <select class="form-control" name="user_id">
                        @foreach ($users as $user)
                        @foreach($associazioni as $a)
                        @if($user->id == $a->user_id)
                        <?php $i++;?>
                        @endif
                        @endforeach
                        @if($i==0)
                        <?php $j++;?>
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                        @endif
                        <?php $i=0;?>
                        @endforeach
                        @if($j==0)
                        <option value="0">Tutti gli utenti disponibili sono già stati assegnati a questo progetto</option>
                        @endif
                    </select>
                </div>
                @if($j!=0)
                <input class="btn btn-primary" type="submit" value="Assegna">
                @endif
            </form>
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
@endsection