@extends('layouts.app')

@section('content')
<?php $i=0;
      $j=0;?>
<div class="row">
    <div class="col-md-12">
            @if (count($elements) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome </th>
                        <th scope="col">Cliente</th>
                        @if(Auth::user()->role == 1)
                        <th scope="col">Azioni</th>
                        @else
                        <th scope="col">Ore Totali Spese</th>
                        @endif 

                    </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $element)
                    @if(Auth::user()->role == 1)
                    <?php $i++;?>
                    <tr>
                        <td>{{ $element->name }}</td>
                        <td>{{ $element->client->PIVA }}</td>

                        <td>
                            <a href="{{ URL::action('ProjectController@show', $element->id) }}" class="btn btn-primary btn-sm"> Vedi </a>
                            <a href="{{ URL::action('ProjectController@assegna', $element->id) }}" class="btn btn-secondary btn-sm"> Assegna </a>
                            <a href="{{ URL::action('ProjectController@destroy', $element->id) }}" class="btn btn-danger btn-sm btn-delete" data-id="{{ $element->id }}"> Cancella </a>
                        </td>
                    </tr>
                    @else
                    <?php $i++;?>
                        @foreach ($lavora as $l)
                            @if((Auth::user()->id == $l->user_id) && ($element->id == $l->project_id))
                            <?php $j++;?> 
                            @endif 
                        @endforeach
                    @if($j >0)
                    <?php $hour_counter=0; ?>
                    <tr>
                        <td>{{ $element->name }}</td>
                        <td>{{ $element->client->PIVA }}</td>
                        @foreach ($schede as $scheda)
                            @if($scheda->project_name == $element->name)
                                <?php $hour_counter=$hour_counter+$scheda->hours_work; ?>        
                            @endif                        
                        @endforeach

                        <td><?php echo $hour_counter;?> </td>
                   
                    </tr>
                    @endif
                    @endif
                    @endforeach
                
            <?php if($i==0) {?>
            <tr><td><p>Non hai progetti assegnati</p></td></tr>
            <?php } ?>
            </tbody>
            </table>
            @else 
                <p>Non sono ancora stati inseriti progetti </p>
            @endif
    </div>        
</div>
@endsection