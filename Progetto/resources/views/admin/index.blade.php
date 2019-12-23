@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary float-md-right" href="{{ URL::action('AdminController@create') }}" >Inserisci Nuovo</a>
    </div>
</div>
<br />
<div class="row">
    <div class="col-md-12">
            @if (count($elements) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ruolo</th>

                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $element)
                    <tr>
                        <td>{{ $element->name }}</td>
                        <td>{{ $element->surname }}</td>
                        <td>{{ $element->email }}</td>
                        @if($element->role==0)
                        <td>Utente semplice</td>
                        @else
                        <td>Utente Admin</td>
                        @endif

                        <td>
                            <a href="{{ URL::action('AdminController@destroy', $element->id) }}" class="btn btn-danger btn-sm btn-delete" data-id="{{ $element->id }}"> Cancella </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else 
                <p>Non sono ancora stati inseriti utenti</p>
            @endif
    </div>        
</div>
@endsection