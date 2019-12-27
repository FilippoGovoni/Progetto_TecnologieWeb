@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Elenco azioni</div>

                <div class="card-body">
                    
                    @if(Auth::user()->role == 1)
                    <p>Hai effettuato l'accesso</p>  
                    @else
                    <p>Hai effettuato l'accesso</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
