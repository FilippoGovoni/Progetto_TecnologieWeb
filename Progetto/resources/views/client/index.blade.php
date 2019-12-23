@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-primary float-md-right" href="{{ URL::action('ClientController@create') }}" >Inserisci Nuovo</a>
    </div>
</div>
<br />
<div class="row">
    <div class="col-md-12">
            @if (count($elements) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ragione sociale </th>
                        <th scope="col">Nome referente</th>
                        <th scope="col">Cognome referente</th>
                        <th scope="col">P.IVA</th>

                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $element)
                    <tr>
                        <td>{{ $element->id }}</td>
                        <td>{{ $element->ragione_sociale }}</td>
                        <td>{{ $element->nome_referente }}</td>
                        <td>{{ $element->cognome_referente }}</td>
                        <td>{{ $element->PIVA }}</td>

                        <td>
                            <a href="{{ URL::action('ClientController@show', $element->id) }}" class="btn btn-primary btn-sm"> Vedi </a>
                            <a href="{{ URL::action('ClientController@destroy', $element->id) }}" class="btn btn-danger btn-sm btn-delete" data-id="{{ $element->id }}"> Cancella </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else 
                <p>Non sono ancora stati inseriti clienti</p>
            @endif
    </div>        
</div>
@endsection