@extends('layouts.app')

@section('content')
<?php $i=0 ?>
<div class="row">
    <div class="col-md-12">
            @if (count($elements) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome </th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Utente</th>

                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $element)
                    @if(Auth::user()->role == 1)
                    <?php $i++;?>
                    <tr>
                        <td>{{ $element->name }}</td>
                        <td>{{ $element->client->PIVA }}</td>
                        @if($element->user->id !=0)
                        <td>{{ $element->user->name }} {{ $element->user->surname }}</td>
                        @else
                        Questo progetto non è stato ancora assegnato
                        @endif

                        <td>
                            <a href="{{ URL::action('ProjectController@edit', $element->id) }}" class="btn btn-primary btn-sm"> Assegna </a>
                            <a href="{{ URL::action('ProjectController@destroy', $element->id) }}" class="btn btn-danger btn-sm btn-delete" data-id="{{ $element->id }}"> Cancella </a>
                        </td>
                    </tr>
                    @else
                    <?php $i++;?>
                    @if(Auth::user()->id == $element->user->id)
                    <tr>
                        <td>{{ $element->name }}</td>
                        <td>{{ $element->client->PIVA }}</td>
                        @if($element->user->id !=0)
                        <td>{{ $element->user->name }} {{ $element->user->surname }}</td>
                        @else
                        Questo progetto non è stato ancora assegnato
                        @endif
                        <td>
                            <a href="{{ URL::action('ProjectController@destroy', $element->id) }}" class="btn btn-danger btn-sm btn-delete" data-id="{{ $element->id }}"> Cancella </a>
                        </td>
                    </tr>
                    @endif
                    @endif
                    @endforeach
                </tbody>
            </table>
            @if($i==0)
            <p>Non hai progetti assegnati</p>
            @endif

            @else 
                <p>Non sono ancora stati inseriti progetti </p>
            @endif
    </div>        
</div>
@endsection