@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director') }}">Curso Solicitudes</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/solicitudes/director/teacher/'.$course) }}">Créditos Profesores</a></li>
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
        <h4 class="text-center"> Solicitudes Curso {{$course}} </h4>

        @if($dirPermission == 1)
        @if($state == 1)
        <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#filters" style="font-weight: bold; float: right;">Filtrar por</button>
        @endif
        @endif
      </div>

      <div class="card-body">
        @if($dirPermission == 1)
        @if($state == 1) 
          <h5 class="text-center" style="font-weight: bold;" id="teacher"></h5>
          <table class="table table-striped" id="miTabla" style="margin-top: 10px;">
            <thead>
              <tr>
                <th scope="col">Asignatura</th>
                <th scope="col" class="text-center">Créditos Seleccionados</th>
                <th scope="col" class="text-center">Créditos Asignatura</th>
                <th scope="col" class="text-center">Créditos Pendientes</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody> 
              @foreach( $arraySolicitudes as $key => $solicitud )
                <tr>
                  <input type="hidden" name="subject_id" id="subject_id" value="{{$solicitud->subject_id}}">
                  <td>{{$solicitud->asig}}</td>
                  <input type="hidden" name="cT" id="cT" value="{{$solicitud->cTheory}}"></input>
                  <input type="hidden" name="cP" id="cP" value="{{$solicitud->cPractice}}"></input>
                  <input type="hidden" name="cP" id="cP" value="{{$solicitud->cSeminar}}"></input>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td><a class="btn btn-secondary btn-sm" href="{{ url('/solicitudes/director/edit/'.$solicitud->id) }}">Editar</a></td>
                  <td><form name="formBorrar" action="{{action('SolicitudesController@deleteSolicitude', $solicitud->id)}}" method="POST" style="display:inline">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()">Borrar</button>
                  </form></td>
                </tr>
              @endforeach
              {!! $arraySolicitudes->render() !!}
            </tbody>
          </table>
        @endif
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
        <form href = "solicitudes/director/index/{$course}" method="GET">

          <div class="form-group">
            <label style="font-weight: bold;">Asignaturas</label>
            <select name="subject_id" id="subject_id" class="form-control">
              <option value="">Asignaturas</option>
              @foreach($arrayAsignaturasProfesores as $a)
                <option value="{{$a->id}}">{{$a->name}}</option>
              @endforeach
            </select>
          </div>

          <button class="btn-info btn-sm" type="submit">Aplicar</button>
          @if($filter != 0)
            <button class="btn-secondary btn-sm" type="submit" style="margin-left: 5px;">Quitar filtros</button>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>

<script language="JavaScript">

  $(document).ready(function() {
    initTableSorter();
    calcular();
  });

  var teacher_id = "{{$teacher_id}}";

  $.ajax({
    url: "{{url('json-teacher')}}",
    type:"GET", 
    data: {"id":teacher_id}, 
    success: function(result){
      $("#teacher").text("Profesor: "+ result.name);
    }
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
    var course = "{{$course}}";
 
    // recorremos cada una de las filas
    filas.forEach(function(e) {
 
        // obtenemos las columnas de cada fila
        var columnas = e.querySelectorAll("td");

        var col = e.querySelectorAll("input");
 
        // obtenemos los valores de la cantidad y importe
        var cT = (col[1].value);
        var cP = (col[2].value);
        var cS = (col[3].value);

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
        columnas[1].textContent=(cT+cP+cS).toFixed(1);

        $.ajax({
          url: "{{url('json-subject')}}",
          type:"GET", 
          data: {"id":col[0].value}, 
          success: function(result){
            var cTeoria = result.cTheory;
            var cPractica = result.cPractice;
            var cSeminario = result.cSeminar;
            cTeoria = parseFloat(cTeoria);
            cPractica = parseFloat(cPractica);
            cSeminario = parseFloat(cSeminario);

            var total = cTeoria+cPractica+cSeminario;
            columnas[2].textContent = total.toFixed(1);
          }
        });

        $.ajax({
          url: "{{url('json-solicitudesSubject')}}",
          type:"GET", 
          data: {"subject_id":col[0].value, "course":course}, 
          success: function(result){
            columnas[3].textContent = result.total.toFixed(1);
          }
        });
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
    var mensaje = confirm('¿Estas seguro de que quieres cerrar las solicitudes?'
                          + ' Una vez cerradas ya no podras modificarlas');
    var enviar = false;

    if(mensaje) {
      document.formPermission.submit();
      enviar = true; 
    }
    return enviar;
  }

  function abrir(){ 
    var mensaje = confirm('¿Estas seguro de que quieres abrir las solicitudes?');
    var enviar = false;

    if(mensaje) {
      document.formPermissionOpen.submit();
      enviar = true; 
    }
    return enviar;
  }

</script>
@stop