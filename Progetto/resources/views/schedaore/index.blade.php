@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(count($elements)>0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Utente</th>
                        <th scope="col">Nome Progetto</th>
                        <th scope="col">Data Scheda</th>
                        <th scope="col">Ore di Lavoro</th>
                        <th scope="col">Note</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elements as $element)
                        <tr>
                            <td>{{ Auth::user()->name }} </td>
                            <td>{{ $element->project_name}} </td>
                            <td>{{ $element->data_scheda}}</td>
                            <td>{{ $element->hours_work}}</td>
                            <td>{{ $element->note}}</td>
                            <td>
                                <form method="POST" action="/schedaore/{{$element->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="btn btn-danger btn-sm btn-delete">Elimina Scheda Ore</button>
                                        </div>
                                    </div> 
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Non è stata inserita alcuna scheda ore</p>
        @endif
    </div>
</div>

@endsection