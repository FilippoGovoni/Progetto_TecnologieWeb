@extends('layouts.app')

@section('content')
@auth
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
                        <th scope="col">Stato</th>
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
                        <td><b>{{ $element->name }}</b></td>
                        <td><b>{{ $element->client->PIVA }}</b></td>
                        @if($element->terminato==1)
                        <td><b><span id="terminato">TERMINATO</span></b></td>
                        @else
                        <td><b><span id="elaborazione">IN ELABORAZIONE</span></b></td>
                        @endif
                        

                        <td>
                            <a href="{{ URL::action('ProjectController@show', $element->id) }}" class="btn btn-primary btn-sm"> Vedi </a>
                            @if($element->terminato==0)
                            <a href="{{ URL::action('ProjectController@assegna', $element->id) }}" class="btn btn-secondary btn-sm"> Assegna </a>
                            @endif
                            <form method="POST" action="/project/{{ $element->id}}">
                                @method('DELETE')  
                                @csrf
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Elimina</button>
                                    </div>
                                </div> 
                            </form>
                        </td>
                    </tr>
                    @else
                    
                        @foreach ($lavora as $l)
                            @if((Auth::user()->id == $l->user_id) && ($element->id == $l->project_id))
                            <?php $j++;?> 
                            <?php $i++;?>
                            @endif 
                        @endforeach
                    @if($j >0)
                    <?php $hour_counter=0; ?>
                    <tr>
                        <td><b>{{ $element->name }}</b></td>
                        <td><b>{{ $element->client->PIVA }}</b></td>
                        @if($element->terminato==1)
                        <td><b><span id="terminato">TERMINATO</span></b></td>
                        @else
                        <td><b><span id="elaborazione">IN ELABORAZIONE</span></b></td>
                        @endif
                        @foreach ($schede as $scheda)
                            @if(($scheda->project_name == $element->name) && (Auth::user()->id == $scheda->user_id))
                                <?php $hour_counter=$hour_counter+$scheda->hours_work; ?>        
                            @endif                        
                        @endforeach

                        <td><b><?php echo $hour_counter;?> </b></td>
                   
                    </tr>
                    @endif
                    <?php $j=0;?>
                    @endif
                    @endforeach
                
            @if($i==0)
            <tr><td><p><b>Non hai progetti assegnati</b></p></td></tr>
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