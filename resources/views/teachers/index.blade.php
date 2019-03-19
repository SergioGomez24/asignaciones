@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Lista de profesores </h4>
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
        @if (Auth()->user()->role == 'Director')
          <a class="btn btn-primary btn-sm" href="{{ url('/teachers/create') }}" style="float: right;">Añadir profesor</a>
        @endif
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Profesor</td>
              @if (Auth()->user()->role == 'Director')
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
              @endif
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayProfesores as $key => $profesor )
              <tr>
                <td><button class="btn btn-light btn-sm" type="button" data-toggle="modal" data-target="#showTeacher" data-whatever="{{$profesor->id}}" style="font-weight: bold;">{{$profesor->name}}</button>
                <div class="modal fade" id="showTeacher" tabindex="-1" role="dialog" aria-labelledby="showTeacherTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="showTeacherTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="group row">
                          <div class="col-md-3">
                            <p style="font-weight: bold;">DNI</p>
                            <p id="dni"></p> 
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Correo electrónico</p>
                            <p id="email">  </p> 
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Rol</p>
                            <p id="role">  </p>  
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Categoría</p>
                            <p id="cat">  </p>
                          </div>
                          <div class="col-md-3" >
                            <p style="font-weight: bold;">Area</p>
                            <p id="area">  </p>
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Créditos iniciales</p>
                            <p id="cInitial"> </p>
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Fecha inicio categoría</p>
                            <p id="dateCategory"> </p>
                          </div>
                          <div class="col-md-3">
                            <p style="font-weight: bold;">Fecha inicio UCA</p>
                            <p id="dateUCA"> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </td>

                @if (Auth()->user()->role == 'Director')
                  <td align="right"><a class="btn btn-secondary btn-sm" href="{{ url('/teachers/edit/'.$profesor->id) }}">Editar</a></td>

                  <td align="right"><form name="formBorrar" action="{{action('TeachersController@deleteTeacher', $profesor->id)}}" method="POST">
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

$(document).ready(initTableSorter);
  
function initTableSorter() {
  // call the tablesorter plugin
  $('table').tablesorter({
    // Sort on the second column, in ascending order
    sortList: [[1,0]]
  });
}

  $('#showTeacher').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget)
    var teacher_id = button.data('whatever');

    console.log(teacher_id);
    $.get('/asignaciones/public/json-teacher?id='+ teacher_id, function(data) {
      $('#showTeacherTitle').empty();
      $('#dni').empty();
      $('#cInitial').empty();
      $('#dateCategory').empty();
      $('#dateUCA').empty();
      $.each(data, function(index, teacherObj) {
        $('#showTeacherTitle').append('<h5>'+ teacherObj.name + '</h5>');
        $('#dni').append('<p>'+ teacherObj.dni +'</p>');
        $('#cInitial').append('<p>'+ teacherObj.cInitial +'</p>');
        $('#dateCategory').append('<p>'+ teacherObj.dateCategory+'</p>');
        $('#dateUCA').append('<p>'+ teacherObj.dateUCA +'</p>');
        $.get('/asignaciones/public/json-category?id='+ teacherObj.category_id, function(d) {
          $('#cat').empty();
          $.each(d, function(index, categoryObj) {
            $('#cat').append('<p>'+ categoryObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-area?id='+ teacherObj.area_id, function(d) {
          $('#area').empty();
          $.each(d, function(index, areaObj) {
            $('#area').append('<p>'+ areaObj.name +'</p>');
          })
        });
        $.get('/asignaciones/public/json-user?id='+ teacherObj.user_id, function(d) {
          $('#role').empty();
          $('#email').empty();
          $.each(d, function(index, userObj) {
            $('#role').append('<p>'+ userObj.role +'</p>');
            $('#email').append('<p>'+ userObj.email +'</p>');
          })
        });
      })
    });
  });

  function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar este profesor?');

    if(mensaje) {
      document.formBorrar.submit();
      return true;
    }else{
      return false;
    }
    
  } 
</script>
@stop