@extends('layouts.app')

@section('content')
<style>
    #card {
        float: left;
    }
</style>
<div class="row">
    <div class="col-md-6">
        <p>
            <h1>Periodo selezionato: <h3>{{ date('d/m/yy', strtotime($data_inizio)) }} - {{ date('d/m/yy', strtotime($data_fine)) }}</h3>
            </h1>
        </p>
    </div>
</div>
<div class="row">
        <?php $totale = 0; ?>
        @if(count($schede_ore)>0)
        @foreach($progetti as $p)
        @foreach($schede_ore as $s)
        @if($s->project_name == $p->name)
        <?php $totale = $totale + $s->hours_work; ?>
        @endif
        @endforeach
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$p->name}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$p->description}}</h6>
                <p class="card-text">Totale ore spese sul progetto {{$totale}}</p>
            </div>
        </div>
        <?php $totale = 0; ?>
        @endforeach
        @else
        Non sono state inserite schede_ore nel periodo selezionato
        @endif
</div>
@endsection