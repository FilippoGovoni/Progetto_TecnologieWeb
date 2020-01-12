@extends('layouts.app')

@section('content')
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
                        <form method="POST" action="/admin/{{ $element->id}}">
                                @method('DELETE')  
                                @csrf
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Elimina Utente</button>
                                    </div>
                                </div> 
                            </form>
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