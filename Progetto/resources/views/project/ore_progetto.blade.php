@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?php $data = date('Y-m-d'); ?>
            <form action="{{ URL::action('ProjectController@ore_progetto') }}" method="GET">
                <table id="table" class="table table-sm">
                    <tr class="table-info">
                        <td>
                            <input type="date" name="data_inizio" aria-label="data_inizio" class="form-control" value=<?php echo date('Y-m-01') ?>>
                        </td>
                        <td>
                            <input id="dat_fin" type="date" name="data_fine" aria-label="data_fine" class="form-control" value=<?php echo date("Y-m-t", strtotime($data)) ?>>
                        </td>
                        <td>
                            <select id="tipo" class="form-control" name="tipologia">
                                <option value="1">Progetti</option>
                                <option value="2">Clienti</option>
                            </select>
                        </td>
                        </td>
                        <td>
                            <div>
                                <input id="ok" class="btn btn-primary" type="submit" value="Cerca">
                            </div>

                        </td>
        </div>
        </tr>
        </table>



        </form>
    </div>
</div><br>
@if($tipologia==1)

<div class="row">
    <?php $totale = 0; ?>
    @if(count($schede_ore)>0)
    @foreach($progetti as $p)
    @foreach($schede_ore as $s)
    @if($s->project_name == $p->name)
    <?php $totale = $totale + $s->hours_work; ?>
    @endif
    @endforeach
    <div id="card1" class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">{{$p->name}}</div>
        <div class="card-body text-secondary">
            <h5 class="card-title">{{$p->description}}</h5>
            <p class="card-text">Totale ore spese sul progetto: <b>{{$totale}} ore</b></p>
        </div>
    </div>
    <?php $totale = 0; ?>
    @endforeach
    @else
    Non sono state inserite schede_ore nel periodo selezionato
    @endif
</div>

@else
<?php $totale = 0; ?>
<div class="row">
    @foreach($clienti as $cliente)
    <div class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">{{$cliente->nome_referente}} {{$cliente->PIVA}}</div>
        <div class="card-body text-secondary">
            @foreach($progetti as $p)
            @if($cliente->id == $p->client->id)
            @foreach($schede_ore as $s)
            @if($s->project_name == $p->name)
            <?php $totale = $totale + $s->hours_work; ?>
            @endif
            @endforeach
            @endif
            @endforeach
            <p class="card-text"> Totale ore spese sui progetti del cliente: <b>{{$totale}} ore</b></p>
        </div>
    </div>
    <?php $totale = 0; ?>
    @endforeach
</div>
@endif
</div>
@endsection