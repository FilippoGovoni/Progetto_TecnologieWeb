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
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Conferma</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Sei sicuro di voler eliminare questo elemento?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancella</button>
            </div>
        </div>
    </div>
</div>
<br>
<ul id="elenco" class="nav nav-pills">

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter"></i> Filtro</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ URL::action('ProjectController@visualizza',2) }}">Tutti</a>
            <a class="dropdown-item" href="{{ URL::action('ProjectController@visualizza',1) }}">Progetti terminati</a>
            <a class="dropdown-item" href="{{ URL::action('ProjectController@visualizza',0) }}">Progetti in elaborazione</a>
    </li>
</ul>
<?php $i = 0;
$j = 0; ?>
<div class="row">
    <div class="col-md-12">
        @if (count($elements) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome </th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Stato</th>
                    @if(Auth::user()->role == 1)
                    <th scope="col">Azioni</th>
                    @else
                    <th scope="col">Ore Totali Spese</th>
                    <th scope="col">Azioni</th>
                    @endif

                </tr>
            </thead>
            <tbody>
                @foreach ($elements as $element)
                @if((Auth::user()->role == 1) && ($element->terminato==$filtro || $filtro==2))
                <?php $i++; ?>
                <tr>
                    <td><b>{{ $element->name }}</b></td>
                    <td><b>{{ $element->client->PIVA }}</b></td>
                    @if($element->terminato==1)
                    <td><button type="button" class="btn btn-success">TERMINATO</button></td>
                    @else
                    <td><button id="elaborazione1" type="button" class="btn btn-secondary">IN ELABORAZIONE <div class="spinner-border text-secondary" role="status"></div></button></td>
                    @endif


                    <td>
                        <a href="{{ URL::action('ProjectController@show', $element->id) }}" class="btn btn-primary btn-sm"> Vedi </a>
                        <form method="POST" action="/project/{{ $element->id}}">
                            @method('DELETE')
                            @csrf
                            <div class="field">
                                <div class="control">
                                    <button id="delete" type="submit" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @else

                @foreach ($lavora as $l)
                @if((Auth::user()->id == $l->user_id) && ($element->id == $l->project_id) && ($element->terminato==$filtro || $filtro==2))
                <?php $j++; ?>
                <?php $i++; ?>
                @endif
                @endforeach
                @if($j >0)
                <?php $hour_counter = 0; ?>
                <tr>
                    <td><b>{{ $element->name }}</b></td>
                    <td><b>{{ $element->client->PIVA }}</b></td>
                    @if($element->terminato==1)
                    <td><button type="button" class="btn btn-success">TERMINATO</button></td>
                    @else
                    <td><button id="elaborazione1" type="button" class="btn btn-warning">IN ELABORAZIONE <div class="spinner-border text-secondary" role="status"></div></button></td>
                    @endif
                    @foreach ($schede as $scheda)
                    @if(($scheda->project_id == $element->id) && (Auth::user()->id == $scheda->user_id))
                    <?php $hour_counter = $hour_counter + $scheda->hours_work; ?>
                    @endif
                    @endforeach

                    <td><b><?php echo $hour_counter; ?> </b></td>
                    <td>
                        <a href="{{ URL::action('ProjectController@show', $element->id) }}" class="btn btn-primary btn-sm"> Vedi </a>
                    </td>
                </tr>
                @endif
                <?php $j = 0; ?>
                @endif
                @endforeach

                @if($i==0)
                <tr>
                    <td>
                        @if($filtro==2)
                        <p><b>Non hai progetti assegnati</b></p>
                        @else
                        <p><b>Non ci sono progetti terminati</b></p>
                        @endif
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        @else
        <p>Non sono ancora stati inseriti progetti </p>
        @endif
    </div>
</div>
@endauth
@guest
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Good Try</strong> Devi effettuare il login per accedere al contenuto: <a class="btn btn-warning" href="{{ route('login') }}">{{ __('Login') }}</a> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection