@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Inserisci un nuovo utente</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ URL::action('AdminController@store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input class="form-control" type="text" name="name" />
                </div>
                <div class="form-group">
                    <label for="surname">Cognome</label>
                    <input class="form-control" type="text" name="surname" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" />
                </div>
                <div class="form-group">
                    <label for="role">Ruolo</label>
                    <select class="form-control" name="role">
                    <option value="0">Utente semplice</option>
                    <option value="1">Utente admin</option>
                    </select>
                </div>


                <div>
                    <input class="btn btn-primary" type="submit" value="Invia">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')