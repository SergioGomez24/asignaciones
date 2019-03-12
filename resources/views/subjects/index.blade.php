@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <div class="text-center">
          <h4> Lista de asignaturas </h4>
        </div>
        @if (Auth()->user()->role == 'Director')
          <a class="btn btn-primary btn-sm" href="{{ url('/subjects/create') }}">Añadir asignatura</a>
        @endif
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Asignatura</th>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </tr>
          </thead>
          <tbody>	
		        @foreach( $arrayAsignaturas as $key => $asignatura )
              <tr>
                <td><a href="{{ url('/subjects/show/' . $asignatura->id ) }}" style="color: #000000; font-weight: bold;" > {{$asignatura->name}} </a></td>

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

