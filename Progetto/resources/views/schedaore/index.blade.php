@extends('layouts.app')
<style>
* {box-sizing: border-box;}
ul {list-style-type: none;}
body {font-family: Verdana, sans-serif;}
.span{
  background-color: #fff;
}
.month {
  padding: 70px 25px;
  width: 100%;
  background: #1abc9c;
  text-align: center;
}

.month ul {
  margin: 0;
  padding: 0;
}

.month ul li {
  color: white;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 3px;
}

.month .prev {
  float: left;
  padding-top: 10px;
}

.month .next {
  float: right;
  padding-top: 10px;
}

.weekdays {
  margin: 0;
  padding: 10px 0;
  background-color: #ddd;
}

.weekdays li {
  display: inline-block;
  width: 13.6%;
  color: #666;
  text-align: center;
}


.days {
  padding: 10px 0;
  background: #eee;
  margin: 0;
}

.days li {
  list-style-type: none;
  display: inline-block;
  width: 15%;
  text-align: center;
  margin-bottom: 100px;
  font-size:20px;
  color: #777;
}


.days li .active {
  padding: 5px;
  background: #1abc9c;
  color: white !important
}

/* Add media queries for smaller screens */
@media screen and (max-width:720px) {
  .weekdays li, .days li {width: 13.1%;}
}

@media screen and (max-width: 420px) {
  .weekdays li, .days li {width: 12.5%;}
  .days li .active {padding: 2px;}
}

@media screen and (max-width: 290px) {
  .weekdays li, .days li {width: 12.2%;}
}
</style>

@section('content')
@auth
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
                            <td>{{ $el->project->name}} </td>
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

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <li class="nav-item dropdown">2020</li>
    
    <button onclick="nomeMese(1)">Gennaio</button>
    <button onclick="nomeMese(2)">Febbraio</button>
    <button onclick="nomeMese(3)">Marzo</button>
    <button onclick="nomeMese(4)">Aprile</button>
    <button onclick="nomeMese(5)">Maggio</button>
    <button onclick="nomeMese(6)">Giugno</button>
    <button onclick="nomeMese(7)">Luglio</button>
    <button onclick="nomeMese(8)">Agosto</button>
    <button onclick="nomeMese(9)">Settembre</button>
    <button onclick="nomeMese(10)">Ottobre</button>
    <button onclick="nomeMese(11)">Novembre</button>
    <button onclick="nomeMese(12)">Dicembre</button>
  </div>
</nav>


<!--
<div class="form-group">
  <label for="month">Seleziona Mese</label>
    <select name="month">
      <option value="1" onclick="nomeMese(1)">Gennaio</option>
      <option value="2" onclick="nomeMese(2)">Febbraio</option>
      <option value="3" onclick="nomeMese(3)">Marzo</option>
      <option value="4" onclick="nomeMese(4)">Aprile</option>
      <option value="5" onclick="nomeMese(5)">Maggio</option>
      <option value="6" onclick="nomeMese(6)">Giugno</option>
      <option value="7" onclick="nomeMese(7)">Luglio</option>
      <option value="8" onclick="nomeMese(8)">Agosto</option>
      <option value="9" onclick="nomeMese(9)">Settembre</option>
      <option value="10" onclick="nomeMese(10)">Ottobre</option>
      <option value="11" onclick="nomeMese(11)">Novembre</option>
      <option value="12" onclick="nomeMese(12)">Dicembre</option>
    </select>
</div>
-->

<div class="month">      
  <ul>
    <li class="prev">&#10094;</li>
    <li class="next">&#10095;</li>
    <li id="Mesetto">Gennaio <br>2020</li>
  </ul>
</div>

<ul class="weekdays">
  <li>Mo</li>
  <li>Tu</li>
  <li>We</li>
  <li>Th</li>
  <li>Fr</li>
  <li>Sa</li>
  <li>Su</li>
</ul>

<ul class="days">  
  <li>1</li>
  <li>2</li>
  <li>3</li>
  <li>4</li>
  <li>5</li>
  <li>6</li>
  <li>7</li>
  <li>8</li>
  <li>9</li>
  <li><span class="active">10</span></li>
  <li>11</li>
  <li>12</li>
  <li>13</li>
  <li>14</li>
  <li>15</li>
  <li>16</li>
  <li>17</li>
  <li>18</li>
  <li>19</li>
  <li>20</li>
  <li>21</li>
  <li>22</li>
  <li>23</li>
  <li>24</li>
  <li>25</li>
  <li>26</li>
  <li>27</li>
  <li>28</li>
  <li>29</li>
  <li>30</li>
  <li>31</li>
</ul>
</div>

<script>
  function nomeMese(valore){
    var mese;
    /*var x = document.getElementById("spawn-calendario");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }*/
    switch(valore){
      case 1:
        mese="Gennaio";
        break;
      case 2:
        mese="Febbraio";
        break;
      case 3:
        mese="Marzo";
        break;
      case 4:
        mese="Aprile";
        break;
      case 5:
        mese="Maggio";
        break;
      case 6:
        mese="Giugno";
        break;
      case 7:
        mese="Luglio";
        break;
      case 8:
        mese="Agosto";
        break;
      case 9:
        mese="Settembre";
        break;
      case 10:
        mese="Ottobre";
        break;
      case 11:
        mese="Novembre"; 
        break;
      case 12:
        mese="Dicembre";
        break;
    }
  document.getElementById("Mesetto").innerHTML =mese+" <br> 2020";
  
}
</script>
@endauth
@endsection