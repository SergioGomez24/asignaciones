@extends('layouts.master')
@section('breadcrumb')
<nav class="bg-light">
  <div class="container">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Asignaturas</li>
  </ol>
  </div>
</nav>
@stop
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <div class="text-center">
          <h4> Lista de asignaturas </h4>
        </div>
        @if (Auth()->user()->role == 'Director')
          <a class="btn btn-primary btn-sm" href="{{ url('/subjects/create') }}" style="float: right;"><i class="fas fa-plus"></i> Añadir asignatura</a>
        @endif
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Asignatura</td>
              @if (Auth()->user()->role == 'Director')
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
              @endif
            </tr>
          </thead>
          <tbody>	
		        @foreach( $arrayAsignaturas as $key => $asignatura )
              <tr>
                <td><button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#showSubject" value="{{$asignatura->id}}" style="font-weight: bold;">{{$asignatura->name}}</button>
                </td>

                @if (Auth()->user()->role == 'Director')
                  <td align="right" ><a class="btn btn-secondary btn-sm" href="{{ url('/subjects/edit/'.$asignatura->id) }}"><i class="fas fa-edit"></i> Editar</a></td>

                  <td align="right" ><form name="formBorrar" action="{{action('SubjectsController@deleteSubject', $asignatura->id)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()"><i class="fas fa-trash"></i> Borrar</button> 
                  </form></td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
		</div>
	</div>
</div>

<div class="modal fade" id="showSubject" tabindex="-1" role="dialog" aria-labelledby="showSubjectTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showSubjectTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="group row">
          <div class="col-md-3">
            <p style="font-weight: bold;">Código</p>
            <p id="code"></p> 
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Titulación</p>
            <p id="cert">  </p> 
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Area</p>
            <p id="area">  </p>  
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Campus</p>
            <p id="cam">  </p>
          </div>
          <div class="col-md-3" >
            <p style="font-weight: bold;">Centro</p>
            <p id="center">  </p>
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Duración</p>
            <p id="duration"> </p>
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Curso</p>
            <p id="imp">  </p>  
          </div>
          <div class="col-md-3" >
            <p style="font-weight: bold;">Tipo</p>
            <p id="typeSubject"> </p>  
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Coordinador</p>
            <p id="coordinator"> </p> 
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Créditos Teoria</p>
            <p id="cT">  </p>
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Créditos Práctica</p>
            <p id="cP">  </p>
          </div>
          <div class="col-md-3">
            <p style="font-weight: bold;">Créditos Seminario</p>
            <p id="cS">  </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script language="JavaScript"> 

  $(document).ready(function() {
    initTableSorter();
  });
  
  function initTableSorter() {
  // call the tablesorter plugin
    $('table').tablesorter({
    // Sort on the second column, in ascending order
      //sortList: [[0,0]]
    });
  }

  var cert_id;
  var area_id;
  var camp_id;
  var cent_id;
  var dur_id;
  var imp_id;
  var type_id;
  var coor_id;

  $('#showSubject').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget)
    var id = button.val();

    $.ajax({
      url: "{{url('json-subject')}}",
      type:"GET", 
      data: {"id":id}, 
      success: function(result){
        $("#showSubjectTitle").text(result.name);
        $("#code").text(result.code);
        $("#cT").text(result.cTheory);  
        $("#cP").text(result.cPractice);
        $("#cS").text(result.cSeminar);
        cert_id = result.certification_id;
        area_id = result.area_id;
        camp_id = result.campus_id;
        cent_id = result.center_id;
        dur_id = result.duration_id;
        imp_id = result.imparted_id;
        type_id = result.typeSubject_id;
        coor_id = result.coordinator_id;

        $.ajax({
          url: "{{url('json-certification')}}",
          type:"GET", 
          data: {"id":cert_id}, 
          success: function(result){
            $("#cert").text(result.name);
          }
        });

        $.ajax({
          url: "{{url('json-area')}}",
          type:"GET", 
          data: {"id":area_id}, 
          success: function(result){
            $("#area").text(result.name);
          }
        });

        $.ajax({
          url: "{{url('json-campus')}}",
          type:"GET", 
          data: {"id":camp_id}, 
          success: function(result){
            $("#cam").text(result.name);
          }
        });

        $.ajax({
          url: "{{url('json-center')}}",
          type:"GET", 
          data: {"id":cent_id}, 
          success: function(result){
            $("#center").text(result.name);
          }
        });

        $.ajax({
          url: "{{url('json-duration')}}",
          type:"GET", 
          data: {"id":dur_id}, 
          success: function(result){
            $("#duration").text(result.name);
          }
        });

        $.ajax({
          url: "{{url('json-imparted')}}",
          type:"GET", 
          data: {"id":imp_id}, 
          success: function(result){
            $("#imp").text(result.name);
          }
        });

        $.ajax({
          url: "{{url('json-typeSubject')}}",
          type:"GET", 
          data: {"id":type_id}, 
          success: function(result){
            $("#typeSubject").text(result.name);
          }
        });

        $.ajax({
          url: "{{url('json-coordinator')}}",
          type:"GET", 
          data: {"id":coor_id}, 
          success: function(result){
            $("#coordinator").text(result.name);
          }
        });
      }
    });    
  });

  $('#showSubject').on('hidden.bs.modal', function(e)
  { 
    e.preventDefault();
    $(this).remove('bs.modal');
  });  

  function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta asignatura?');
    var enviar = false;

    if(mensaje) {
      document.formBorrar.submit();
      enviar = true; 
    }
    return enviar;
  } 
</script>
@stop

