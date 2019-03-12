@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <div class="text-center">
          <h4> Lista de profesores </h4>
        </div>
        @if (Auth()->user()->role == 'Director')
          <a class="btn btn-primary btn-sm" href="{{ url('/teachers/create') }}">Añadir profesor</a>
        @endif
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Profesor</td>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayProfesores as $key => $profesor )
              <tr>
                <td><a href="{{ url('/teachers/show/' . $profesor->id ) }}" style="color: #000000; font-weight: bold;" > {{$profesor->name}} </a></td>

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