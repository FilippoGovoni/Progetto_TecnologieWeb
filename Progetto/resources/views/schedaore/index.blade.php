@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(count($schede)>0)
        <?php $i=0;?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome Progetto</th>
                        <th scope="col">Data Scheda</th>
                        <th scope="col">Ore di Lavoro</th>
                        <th scope="col">Note</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schede as $el)
                    @if(Auth::user()->id == $el->user_id)
                    <?php $i++;?>
                        <tr>
                            <td>{{ $el->project_name}} </td>
                            <td>{{ date('d-m-yy', strtotime($el->data_scheda))}}</td>
                            <td>{{ $el->hours_work}}</td>
                            <td>{{ $el->note}}</td>
                            <td>
                                <form method="POST" action="/schedaore/{{ $el->id}}">
                                @method('DELETE')  
                                @csrf
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Elimina Scheda</button>
                                    </div>
                                </div> 
                                </form>
                            
                            </td>
                        </tr>
                    @endif
                    @endforeach
                    @if($i==0)
                    <tr><td><p><b>Non hai ancora creato una scheda ore </b></p></td></tr>
                    @endif
                </tbody>
            </table>
        @else
            <p>Non è stata inserita alcuna scheda ore</p>
        @endif
    </div>
</div>

@endsection