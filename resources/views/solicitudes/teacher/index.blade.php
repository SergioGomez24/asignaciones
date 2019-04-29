@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/teacher') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Solicitudes Curso {{$course}}</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Selecciones Curso {{$course}} </h4>

        @if($profPermission == 1)
        <form name="formPermission" action="{{action('SolicitudesController@editPermissionProf', $course)}}" method="POST">
          {{ method_field('POST') }}
          {{ csrf_field() }}
          <button class="btn btn-primary btn-sm" type="submit" onclick="return validar()" style="float: left; margin-left: 5px;">Enviar</button>
        </form>

        <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#filters" style="font-weight: bold; float: right;">Filtrar por</button>
        @endif
      </div>

      <div class="card-body">
        @if($profPermission == 1)
          <h5 class="text-center" style="font-weight: bold;">Profesor: {{ auth()->user()->name }}</h5>
          <h6 style="float: right; font-weight: bold;">Créditos acumulados: {{$contCréditosProf}} de {{$cInitial}}</h6>
          <table class="table table-striped" id="miTabla">
            <thead>
              <tr>
                <th scope="col">Asignatura</th>
                <th scope="col">Créditos Teoría</th>
                <th scope="col">Créditos Prácticas</th>
                <th scope="col">Créditos Seminarios</th>
                <th scope="col">Total</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              @foreach( $arraySolicitudesProf as $key => $solicitud )
                <tr>
                  <td>{{$solicitud->asig}}</td>
                  <td class="text-center">{{$solicitud->cTheory}}</td>
                  <td class="text-center">{{$solicitud->cPractice}}</td>
                  <td class="text-center">{{$solicitud->cSeminar}}</td>
                  <td></td>
                  <td><a class="btn btn-secondary btn-sm" href="{{ url('/solicitudes/edit/'.$solicitud->id) }}">Editar</a></td>
                  <td><form name="formBorrar" action="{{action('SolicitudesController@deleteSolicitude', $solicitud->id)}}" method="POST" style="display:inline">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()">Borrar</button>
                  </form></td>
                </tr>
              @endforeach
            {!! $arraySolicitudesProf->render() !!}
          </tbody>
        </table>
        @else
          <h6>Las solicitudes no están disponibles</h6>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="filters" tabindex="-1" role="dialog" aria-labelledby="filtersTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Filtrar por</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="bntCerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form href = "solicitudes/course/{$course}" method="GET">

          <div class="form-group">
            <label style="font-weight: bold;">Asignaturas</label>
            <select name="subject_id" id="subject_id" class="form-control">
              <option value="">Asignaturas</option>
              @foreach($arrayAsignaturasTeacher as $a)
                <option value="{{$a->id}}">{{$a->name}}</option>
              @endforeach
            </select>
          </div>

          <button class="btn-info btn-sm" type="submit">Aplicar</button>
          @if($filter != 0)
            <button class="btn-secondary btn-sm" type="submit" style="margin-left: 5px;">Quitar filtros</button>
          @endif
        </form>
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
    var filas=document.querySelectorAll("#miTabla tbody tr");
 
    // recorremos cada una de las filas
    filas.forEach(function(e) {
 
        // obtenemos las columnas de cada fila
        var columnas=e.querySelectorAll("td");
 
        // obtenemos los valores de la cantidad y importe
        var cT = (columnas[1].textContent);
        var cP = (columnas[2].textContent);
        var cS = (columnas[3].textContent);

        if(cT == ""){
          cT = 0;
        }

        if(cP == ""){
          cP = 0;
        }

        if(cS == ""){
          cS = 0;
        }

        cT = parseFloat(cT);
        cS = parseFloat(cS);
        cP = parseFloat(cP);
 
        // mostramos el total por fila
        columnas[4].textContent=(cT+cP+cS).toFixed(1);
    });
  }

  function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta solicitud?');
    var enviar = false;

    if(mensaje) {
      document.formBorrar.submit();
      enviar = true; 
    }
    return enviar;
  }

  function validar(){ 
    var mensaje = confirm('¿Estas seguro de que quieres enviar las solicitudes definitivamente?'+
                          ' Una vez enviadas ya no podras modificarlas');
    var enviar = false;

    if(mensaje) {
      document.formPermission.submit();
      enviar = true; 
    }
    return enviar;
  }

</script>
@stop