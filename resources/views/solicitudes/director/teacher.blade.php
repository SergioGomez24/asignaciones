@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Créditos Profesores</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-2 col-md-8">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Créditos Profesores Curso {{$course}} </h4>
        <div class="card-body">
          <table class="table table-striped" id="miTabla">
            <thead>
              <tr>
                <th scope="col">Profesor</th>
                <th scope="col" class="text-center">Créditos Iniciales</th>
                <th scope="col" class="text-center">Créditos Escogidos</th>
                <th scope="col" class="text-center">Créditos Disponibles</th>
              </tr>
            </thead>
            <tbody> 
              @foreach( $arrayProfesores as $key => $profesor )
                <tr>
                  <td><a href="{{ url('/solicitudes/director/index',['course' => $course, 'teacher_id' => $profesor->id])}}">{{$profesor->name}}</a></td>
                  <td class="text-center">{{$profesor->cInitial}}</td>
                  <td class="text-center"></td>
                  <td class="text-center">{{$profesor->cAvailable}}</td>
                </tr>
              @endforeach
              {!! $arrayProfesores->render() !!}
            </tbody>
            <tfoot>
              <tr>
                <td style="font-weight: bold;">Total</td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script language="JavaScript">

  $(document).ready(function() {
    initTableSorter();
    calcular();
  });
  
  function initTableSorter() {
  // call the tablesorter plugin
    $('table').tablesorter({
    // Sort on the second column, in ascending order
     // sortList: [[1,0]]
    });
  }

  function calcular() {
    // obtenemos todas las filas del tbody
    var filas = document.querySelectorAll("#miTabla tbody tr");

    var totalI = 0;
    var totalE = 0;
 
    // recorremos cada una de las filas
    filas.forEach(function(e) {
 
        // obtenemos las columnas de cada fila
        var columnas = e.querySelectorAll("td");

        var cI = (columnas[1].textContent);
        var cD = (columnas[3].textContent);
        var cE = 0;

        if(cI == ""){
          cI = 0;
        }

        if(cD == ""){
          cD = 0;
        }

        cI = parseFloat(cI);
        cD = parseFloat(cD);
        cE = cI-cD;

        columnas[2].textContent = cE;

        totalI += cI;
        totalE += cE;
    });

    // mostramos la suma total
   	var filas = document.querySelectorAll("#miTabla tfoot tr td");
    filas[1].textContent = totalI.toFixed(1);
    filas[2].textContent = totalE.toFixed(1);   
  }
</script>
@stop

