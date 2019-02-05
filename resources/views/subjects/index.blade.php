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
            	<h5 > Lista de asignaturas </h5>
            </div>
            @if (Auth()->user()->role == 'Director')
            <div id="btnCabecera">
            	<a class="btn btn-primary btn-sm" href="{{ url('/subjects/create') }}">Añadir asignatura</a>
            </div>
            @endif
          </div>
          <div class="card-body">	
		  @foreach( $arrayAsignaturas as $key => $asignatura )
		  <div id="nombrelist">
			<h5><a href="{{ url('/subjects/show/' . $asignatura->id ) }}" style="color: #000000;">{{$asignatura->name}}</a></h5>
		  </div>
      @if (Auth()->user()->role == 'Director')
		  <div id="iconoBorrar">
		  	<form name="formBorrar" action="{{action('SubjectsController@deleteSubject', $asignatura->id)}}" method="POST" style="display:inline">
        		  {{ method_field('DELETE') }}
        		  {{ csrf_field() }}
        		  <input class="btn btn-danger btn-sm" type="submit" onclick="pregunta()" value="Borrar"/>
      	</form>
		  </div>
		  <div id="iconoEditar">
			<a class="btn btn-secondary btn-sm" href="{{ url('/subjects/edit/'.$asignatura->id) }}">Editar</a>
		  </div>
      @endif
		  </br><hr />
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop