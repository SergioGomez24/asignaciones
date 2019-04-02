@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center"> Lista de cursos asignatura </h4>
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/settings') }}"><img src="{{ asset('img/keyboard_return.png') }}" height="15" width="15"/></a></button>
        <a class="btn btn-primary btn-sm" href="{{ url('/settings/coursesSubjects/create') }}" style="float: right;">Añadir curso asignatura</a>
      </div>
      <div class="card-body">	
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Curso Asignatura</td>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayCursosAsignatura as $key => $cursoAsignatura )
              <tr>
                <td style="font-weight: bold;">{{$cursoAsignatura->name}}</td>

                <td align="right" ><a class="btn btn-secondary btn-sm" href="{{ url('/settings/coursesSubjects/edit/'.$cursoAsignatura->id) }}">Editar</a></td>

                <td align="right" ><form name="formBorrar" action="{{action('CoursesSubjectsController@deleteCourseSubject', $cursoAsignatura->id)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                  <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()">Borrar</button> 
                </form></td>
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

  function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar este curso asignatura?');
    if(mensaje) {
       document.formBorrar.submit();
       return true; 
    } else {
      return false;
    }
  } 
</script>
@stop