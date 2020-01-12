@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <p>
            <h1>Periodo selezionato</h1>
        </p>
        <p><h2><b>{{ $data_inizio }} - {{ $data_fine }}</b></h2></p>
        <?php $totale=0;?>
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
                <?php $totale=0;?>
            @endforeach
        @else
            Non sono state inserite schede_ore nel periodo selezionato
        @endif
    </div>
</div>
@endsection