@extends('layouts.master')
@section('content')
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

	<div class="row" style="margin-top:40px">
   	  <div class="col-md-12">
        <div class="card">
          <div class="card-header">
          	<div id="titlistado">
            	<h5> Lista de profesores </h5>
            </div>
            <div id="btnAñadir">
            	<a class="btn btn-primary btn-sm" href="{{ url('/teachers/create') }}">Añadir profesor</a>
            </div>
          </div>
          <div class="card-body">	
		  @foreach( $arrayProfesores as $key => $profesor )
		  <div id="nombrelist">
			<h5><a href="{{ url('/teachers/show/' . $profesor->id ) }}" style="color: #000000;">{{$profesor->name}}</a></h5>
		  </div>
		  <div id="iconoBorrar">
		  	<form name="formBorrar" action="{{action('TeachersController@deleteTeacher', $profesor->id)}}" method="POST" style="display:inline">
        		  {{ method_field('DELETE') }}
        		  {{ csrf_field() }}
        		  <input class="btn btn-danger btn-sm" type="button" onclick="pregunta()" value="Borrar"/>
      		</form>
		  </div>
		  <div id="iconoEditar">
			<a class="btn btn-secondary btn-sm" href="{{ url('/teachers/edit/'.$profesor->id) }}">Editar</a>
		  </div>
		  </br><hr />
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop