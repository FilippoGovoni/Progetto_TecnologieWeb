@extends('layouts.app')
<!--
<style>
* {box-sizing: border-box;}
ul {list-style-type: none;}
body {font-family: Verdana, sans-serif;}

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
  padding: 20px;
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
-->
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

<!--
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
<div class="month">      
  <ul>
    <li class="prev">&#10094;</li>
    <li class="next">&#10095;</li>
    <li>
      August<br>
      <span style="font-size:18px">2017</span>
    </li>
  </ul>
</div>


    
<ul class="days">
  <li>1<br> Ore lavoro=3</li>
  <li>2</li>
  <li>3</li>
  <li>4<br> Ore lavoro= 2</li>
  <li>5</li>
  <li>6</li>
  <li>7</li>
  <li>8</li>
  <li>9</li>
  <li>10</li>
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
  <li><span class="active">23</span></li>
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
</nav>
-->
@endauth
@endsection