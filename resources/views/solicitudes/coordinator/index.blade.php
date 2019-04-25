@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/coordinators') }}">Curso Solicitudes</a></li>
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

        @if($coorPermission == 1)
        <form name="formPermission" action="{{action('SolicitudesController@editPermissionCoor', $course)}}" method="POST" style="display:inline">
          {{ method_field('POST') }}
          {{ csrf_field() }}
          <button class="btn btn-primary btn-sm" type="submit" onclick="return validar()" style="float: left; margin-left: 5px;">Enviar</button>
        </form>
        
        <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="font-weight: bold; float: right;">Filtrar por</button>
        @endif
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <form href = "coordinators/index/{$course}" method="GET">
              <div class="group row">

                <div class="col-md-3">
                  <select name="teacher" id="teacher" class="form-control">
                    <option value="">Profesores</option>
                    @foreach($arrayProfesores as $p)
                      <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                  </select>
                </div>
                <button class="btn-info btn-sm" type="submit">Aplicar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card-body">
        @if($coorPermission == 1)
          <form href = "coordinators/index/{$course}" method="GET">
            <h6><label for="subject">Selecciona una asignatura</label></h6>
            <select name="subject" id="subject" class="form-control" required>
              <option value="">Elige una asignatura</option>
              @foreach($arrayAsignaturasCoor as $a)
                <option value="{{$a->id}}">{{$a->name}}</option>
              @endforeach
            </select>
          </form>

          @if($subject_id != "")

            <h4 class="text-center" id="titulo" style="margin-top: 10px;"></h4>

            <table class="table table-striped" id="miTabla" style="margin-top: 10px;">
              <thead>
                <tr>
                  <th scope="col">Profesor</th>
                  <th scope="col">Créditos Disponibles Profesor</th>
                  <th scope="col">Créditos Teoría</th>
                  <th scope="col">Créditos Prácticas</th>
                  <th scope="col">Créditos Seminarios</th>
                  <th scope="col">Total</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $arraySolicitudesCoor as $key => $solicitud )
                  <tr>
                    <td>{{$solicitud->prof}}</td>
                    <td></td>
                    <td class="text-center">{{$solicitud->cTheory}}</td>
                    <td class="text-center">{{$solicitud->cPractice}}</td>
                    <td class="text-center">{{$solicitud->cSeminar}}</td>
                    <td></td>
                    <td><a class="btn btn-secondary btn-sm" href="{{ url('/coordinators/edit/'.$solicitud->id) }}">Editar</a></td>
                    <td>
                      <form name="formBorrar" action="{{action('CoordinatorsController@deleteSolicitudeCoor', $solicitud->id)}}" method="POST" style="display:inline">
                      {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                      <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()">Borrar</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
                {!! $arraySolicitudesCoor->render() !!}
              </tbody>
              <tfoot>
                <tr>
                  <td colspan=2 style="font-weight: bold;">Total Solicitudes</td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td class="text-center"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td colspan=2 style="font-weight: bold;">Total Asignatura</td>
                  <td class="text-center" id="cT"></td>
                  <td class="text-center" id="cP"></td>
                  <td class="text-center" id="cS"></td>
                  <td id="cTotal"></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          @endif
        @else
          <h6>Las solicitudes del coordinador no está disponible</h6>
        @endif
      </div>
    </div>
  </div>
</div>

<script language="JavaScript">

  $(document).ready(function(){
    initTableSorter();
    calcular();
  });

  var select = document.getElementById('subject');
  var asig = "{{$subject_id}}";
  var cTotal = 0;
  var ct = 0;
  var cp = 0;
  var cs = 0;

  select.addEventListener('change', function(){
    this.form.submit();
  }, false);


  $.ajax({
    url: "{{url('json-subject')}}",
    type:"GET", 
    data: {"id":asig}, 
    success: function(result){
      $("#titulo").text("Solicitudes "+ result.name);
      $("#cT").text(result.cTheory);  
      $("#cP").text(result.cPractice);
      $("#cS").text(result.cSeminar);
      ct = result.cTheory;
      cp = result.cPractice;
      cs = result.cSeminar;
      ct = parseFloat(ct);
      cp = parseFloat(cp);
      cs = parseFloat(cs);
      cTotal = ct + cp + cs;
      $("#cTotal").text(cTotal);
    }
  });

  
  function initTableSorter() {
  // call the tablesorter plugin
    $('table').tablesorter({
    // Sort on the second column, in ascending order
    //  sortList: [[1,0]]
    });
  }

  function calcular() {
    // obtenemos todas las filas del tbody
    var filas = document.querySelectorAll("#miTabla tbody tr");
    
    var totalT = 0;
    var totalP = 0;
    var totalS = 0;
    var total = 0;
 
    // recorremos cada una de las filas
    filas.forEach(function(e) {
 
        // obtenemos las columnas de cada fila
        var columnas = e.querySelectorAll("td");
 
        // obtenemos los valores
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
        columnas[5].textContent = (cT+cP+cS).toFixed(1);
        
        totalT += cT;
        totalP += cP;
        totalS += cS;
        total += cT+cP+cS;
    });
 
    // mostramos la suma total
    var filas = document.querySelectorAll("#miTabla tfoot tr td");
    filas[1].textContent = totalT.toFixed(1);
    filas[2].textContent = totalP.toFixed(1);
    filas[3].textContent = totalS.toFixed(1);
    filas[4].textContent = total.toFixed(1);
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
    var mensaje = confirm('¿Estas seguro de que quieres enviar las solicitudes definitivamente?'
      + ' Una vez enviadas ya no podras modificarlas');
    var enviar = false;

    if(mensaje) {
      document.formPermission.submit();
      enviar = true; 
    }
    return enviar;
  }

</script>
@stop