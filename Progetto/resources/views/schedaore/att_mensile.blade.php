
@extends('layouts.app')
@section('link')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Icone -->
    <script src="https://kit.fontawesome.com/a697c89225.js" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script type="text/javascript" src="../assets/js/jquery-3.2.0.min.js"></script>
@endsection

@section('content')
    @auth
        
        <fieldset>
        <?php $mesi=['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];?>
        <table class="table" >
            <thead>
                <tr>
                    <th scope="col">Nome Progetto</th>
                    <th scope="col">Data : 
                    <select name="Mese" id="id_Mese" onchange="meseSelz()">
                    @for($i=0;$i < 12;$i++)
                    @if($i+1 == $month)
                    <option value="{{$i+1}}" selected>{{ $mesi[$i] }}</option>
                    @else
                    <option value="{{$i+1}}">{{ $mesi[$i] }}</option>
                    @endif
                    @endfor
                    <!--
                        <option selected>Mese</option>
                        <option value="01">Gennaio</option>
                        <option value="02">Febbraio</option>
                        <option value="03">Marzo</option>
                        <option value="04">Aprile</option>
                        <option value="05">Maggio</option>  
                        <option value="06">Giugno</option>
                        <option value="07">Luglio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Settembre</option>
                        <option value="10">Ottobre</option>
                        <option value="11">Novembre</option>
                        <option value="12">Dicembre</option>-->
                    </select>
                    </th>
                    <th scope="col">Ore di Lavoro</th>
                    <th scope="col">Note</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schede as $el)
                @if(Auth::user()->id == $el->user_id)
                    <tr>
                        <td>{{ $el->project->name}} </td>
                        <td>{{ date('d-m-y', strtotime($el->data_scheda))}}</td>
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
            </tbody>
        </table>
        </fieldset>

        <script>
        function meseSelz(){
            var valor = document.getElementById("id_Mese").value;
            var mese;
            var url = '{{ route("att_mensile",":valor") }}';
            url=url.replace(':valor',valor);
            window.location.href=url;
        }
        </script>


    @endauth


    @guest
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Good Try</strong> Devi effettuare il login per accedere al contenuto: <a class="btn btn-warning" href="{{ route('login') }}">{{ __('Login') }}</a> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endguest
@endsection  