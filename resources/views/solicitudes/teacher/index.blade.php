@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Selecciones Curso {{$course}} </h4>
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/solicitudes/teacher') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>

        @if($profPermission == 1)
        <form name="formPermission" action="{{action('SolicitudesController@editPermissionProf', $course)}}" method="POST">
          {{ method_field('POST') }}
          {{ csrf_field() }}
          <button class="btn btn-primary btn-sm" type="submit" onclick="return validar()" style="float: left; margin-left: 5px;">Enviar</button>
        </form>

        <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="font-weight: bold; float: right;">Filtrar por</button>
        @endif
        <div class="col-md-12">
        <div class="collapse" id="collapseExample" style="float: right;">
          <div class="card card-body">
            <form href = "solicitudes/course/{$course}" method="GET">
              <div class="group row">

                <div class="col-md-9">
                  <select name="subject_id" id="subject_id" class="form-control">
                    <option value="">Asignaturas</option>
                    @foreach($arrayAsignaturasTeacher as $a)
                      <option value="{{$a->id}}">{{$a->name}}</option>
                    @endforeach
                  </select>
                </div>
                <button class="btn-info btn-sm" type="submit">Aplicar</button>
              </div>
            </form>
          </div>
        </div>
        </div>
      </div>

      <div class="card-body">
        @if($profPermission == 1)
          <h6 style="float: right; font-weight: bold;">Créditos acumulados: {{$contCréditosProf}} de {{$cInitial}}</h6>
          <table class="table table-striped" id="miTabla">
            <thead>
              <tr>
                <th scope="col">Asignatura</th>
                <th scope="col">Profesor</th>
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
                  <td>{{$solicitud->prof}}</td>
                  <td>{{$solicitud->cTheory}}</td>
                  <td>{{$solicitud->cPractice}}</td>
                  <td>{{$solicitud->cSeminar}}</td>
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
        var cT = (columnas[2].textContent);
        var cP = (columnas[3].textContent);
        var cS = (columnas[4].textContent);

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
        columnas[5].textContent=(cT+cP+cS).toFixed(1);
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