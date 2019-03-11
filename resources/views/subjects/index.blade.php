@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <div class="text-center">
          <h5 > Lista de asignaturas </h5>
        </div>
        @if (Auth()->user()->role == 'Director')
          <a class="btn btn-primary btn-sm" href="{{ url('/subjects/create') }}">Añadir asignatura</a>
        @endif
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Asignatura</td>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </div>
            </tr>
          </thead>
          <tbody>	
		        @foreach( $arrayAsignaturas as $key => $asignatura )
              <tr>
                <td><a href="{{ url('/subjects/show/' . $asignatura->id ) }}" style="color: #000000; font-weight: bold;" >{{$asignatura->name}}</a></td>
                @if (Auth()->user()->role == 'Director')
                  <td align="right"><a class="btn btn-secondary btn-sm" href="{{ url('/subjects/edit/'.$asignatura->id) }}">Editar</a></td>
                  <td align="right"><form name="formBorrar" action="{{action('SubjectsController@deleteSubject', $asignatura->id)}}" method="POST" style="display:inline">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input class="btn btn-danger btn-sm" type="submit" onclick="pregunta()" value="Borrar"/>
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
function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta asignatura?');
    if(mensaje) {
       document.formBorrar.submit();
       return true; 
    } else {
      return false;
    }
} 
</script>
@stop

