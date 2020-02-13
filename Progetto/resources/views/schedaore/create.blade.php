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
<?php class MAX
{
    public $max;
    public $id;
} ?>
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
        <?php $numero_progetti=0;?>
            @foreach($elements as $l)
            @if(Auth::user()->id == $l->user_id)
            @if($l->project->terminato ==0)
            <?php $numero_progetti++;?>
            @endif
            @endif
            @endforeach

        @if ($elements->all()>0 && $numero_progetti>0)
        <form action="{{ URL::action('SchedaoreController@store') }}" method="POST">
            {{ csrf_field()}}

            <div class="form-group">
                <label for="data_scheda">Data Della Scheda</label>
                <input class="form-control" type="date" name="data_scheda" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" />
            </div>
            <?php $totale = 0;
            $max = new MAX(); ?>
            @foreach($elements as $l)
            @if(Auth::user()->id == $l->user_id)
            @foreach($schede as $s)
            @if(($s->project_id == $l->project->id) && (Auth::user()->id == $s->user_id) && ($l->project->terminato == 0))
            <?php $totale = $totale + $s->hours_work; ?>
            @endif
            @endforeach
            @if($totale>$max->max)
            <?php $max->max = $totale;
            $max->id = $l->project->id; ?>
            @endif
            <?php $totale = 0; ?>
            @endif
            @endforeach
            <div class="form-group">
                <label for="project_id">Progetto</label>
                <select class="form-control" name="project_id">
                    @foreach ($elements as $project)
                    @if( ($project->user_id == Auth::user()->id) && ($project->project->terminato==0))
                    @if($project->project->id == $max->id)
                    <option value="{{ $project->project->id }}" selected>{{ $project->project->name }} </option>
                    @else
                    <option value="{{ $project->project->id }}">{{ $project->project->name }} </option>
                    @endif
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hours_work">Numero di ore</label>
                <input class="form-control" type="number" name="hours_work" min="0" max="24"/>
            </div>

            <div class="form-group">
                <label for="note">Note</label>
                <textarea name="note" cols="50" rows="5"></textarea>
            </div>

            <input type="hidden" name="user_id" value="{{ Auth::user()->id  }}">
            
            <input class="btn btn-primary" type="submit" value="Conferma scheda ore">
        </form>
        @else
        <br>
        <h4>Non hai progetti assegnati o i progetti sono terminati</h4>
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
@endsection('content')