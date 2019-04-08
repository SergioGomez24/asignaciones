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
                <td><button class="btn btn-light btn-sm" data-toggle="modal" data-target="#showTeacher" value="{{$profesor->id}}" style="font-weight: bold;">{{$profesor->name}}</button>
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

<div class="modal fade" id="showTeacher" tabindex="-1" role="dialog" aria-labelledby="showTeacherTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showTeacherTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="bntCerrar">
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

<script language="JavaScript"> 

$(document).ready(initTableSorter);
  
function initTableSorter() {
  // call the tablesorter plugin
  $('table').tablesorter({
    // Sort on the second column, in ascending order
   // sortList: [[1,0]]
  });
}

$('#showTeacher').on('show.bs.modal', function(e) {
  var button = $(e.relatedTarget)
  var id = button.val();

  $.ajax({
    url: "{{url('json-teacher')}}",
    type:"GET", 
    data: {"id":id}, 
    success: function(result){
      $("#showTeacherTitle").text(result.name);
      $("#dni").text(result.dni);
      $("#cInitial").text(result.cInitial);
      $("#dateCategory").text(result.dateCategory);  
      $("#dateUCA").text(result.dateUCA);
      $.ajax({
        url: "{{url('json-category')}}",
        type:"GET", 
        data: {"id":result.category_id}, 
        success: function(result){
          $("#cat").text(result.name);
        }
      });
      $.ajax({
        url: "{{url('json-area')}}",
        type:"GET", 
        data: {"id":result.area_id}, 
        success: function(result){
          $("#area").text(result.name);
        }
      });
      $.ajax({
        url: "{{url('json-user')}}",
        type:"GET", 
        data: {"id":result.user_id}, 
        success: function(result){
          $("#role").text(result.role);
          $("#email").text(result.email);
        }
      });
    }
  });
});

$('#bntCerrar').on('hidden.bs.modal', function(e)
{ 
  $(this).removeData('bs.modal');
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