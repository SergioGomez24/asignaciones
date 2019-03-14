@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <div class="text-center">
          <h4> Lista de asignaturas </h4>
        </div>
        <a href="{{ url('/') }}"><img src={{ asset('img/keyboard_return.png') }} height="25" width="25" style="float: left;" /></a>
        @if (Auth()->user()->role == 'Director')
          <a class="btn btn-primary btn-sm" href="{{ url('/subjects/create') }}" style="float: right;">Añadir asignatura</a>
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
                <td><button class="btn btn-light btn-sm" type="button" data-toggle="modal" data-target="#showSubject" data-whatever="{{$asignatura->id}}" style="font-weight: bold;">{{$asignatura->name}}</button>
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
                </td>

                @if (Auth()->user()->role == 'Director')
                  <td align="right" ><a class="btn btn-secondary btn-sm" href="{{ url('/subjects/edit/'.$asignatura->id) }}">Editar</a></td>

                  <td align="right" ><form name="formBorrar" action="{{action('SubjectsController@deleteSubject', $asignatura->id)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()">Borrar</button> 
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

<script language="JavaScript"> 

  $('#showSubject').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget)
    var subject_id = button.data('whatever');

    console.log(subject_id);
    $.get('/asignaciones/public/json-subject?id='+ subject_id, function(data) {
      $('#showSubjectTitle').empty();
      $('#code').empty();
      $('#coordinator').empty();
      $('#cT').empty();
      $('#cP').empty();
      $('#cS').empty();
      $.each(data, function(index, subjectObj) {
        $('#showSubjectTitle').append('<h5>'+ subjectObj.name + '</h5>');
        $('#code').append('<p>'+ subjectObj.code +'</p>');
        $('#coordinator').append('<p>'+ subjectObj.coordinator +'</p>');
        $('#cT').append('<p>'+subjectObj.cTheory+'</p>');
        $('#cP').append('<p>'+subjectObj.cPractice+'</p>');
        $('#cS').append('<p>'+subjectObj.cSeminar+'</p>');
        $.get('/asignaciones/public/json-certification?id='+ subjectObj.certification_id, function(d) {
          $('#cert').empty();
          $.each(d, function(index, certificationObj) {
            $('#cert').append('<p>'+ certificationObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-area?id='+ subjectObj.area_id, function(d) {
          $('#area').empty();
          $.each(d, function(index, areaObj) {
            $('#area').append('<p>'+ areaObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-campus?id='+ subjectObj.campus_id, function(d) {
          $('#cam').empty();
          $.each(d, function(index, campusObj) {
            $('#cam').append('<p>'+ campusObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-center?id='+ subjectObj.center_id, function(d) {
          $('#center').empty();
          $.each(d, function(index, centerObj) {
            $('#center').append('<p>'+ centerObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-duration?id='+ subjectObj.duration_id, function(da) {
          $('#duration').empty();
          $.each(da, function(index, durationObj) {
            $('#duration').append('<p>'+ durationObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-imparted?id='+ subjectObj.imparted_id, function(da) {
          $('#imp').empty();
          $.each(da, function(index, impartedObj) {
            $('#imp').append('<p>'+ impartedObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-typeSubject?id='+ subjectObj.typeSubject_id, function(dat) {
          $('#typeSubject').empty();
          $.each(dat, function(index, typeSubjectObj) {
            $('#typeSubject').append('<p>'+ typeSubjectObj.name +'</p>');
          })
        });
      })
    });
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

