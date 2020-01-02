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
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Nome e Cognome</span>
                    </div>
                    <input type="text" name="name" aria-label="First name" class="form-control">
                    <input type="text" name="surname" aria-label="Last name" class="form-control">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>
                    <input type="text" name="email" class="form-control" placeholder=" " aria-label="email" aria-describedby="basic-addon1">
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