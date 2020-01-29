@extends('layouts.app')
@section('link')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<!--Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- Icone -->
<script src="https://kit.fontawesome.com/a697c89225.js" crossorigin="anonymous"></script>
<!-- JQuery -->
<script type="text/javascript" src="../assets/js/jquery-3.2.0.min.js"></script>
@endsection
@section('content')
@auth
<div class="container">
    <div class="row">
        <div class="col-md-6">

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
</div
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