@extends('layouts.master')
@section('content')
<script language="JavaScript"> 
function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar este centro?');
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
            	<h5 > Lista de centros </h5>
            </div>
            <div id="btnAñadir">
            	<a class="btn btn-primary btn-sm" href="{{ url('/settings/centers/create') }}">Añadir centro</a>
            </div>
          </div>
          <div class="card-body">	
		  @foreach( $arrayCentros as $key => $centro )
		  <div id="nombrelist">
			<h5><a href="{{ url('/settings/centers/show/' . $centro->id ) }}" style="color: #000000;">{{$centro->name}}</a></h5>
		  </div>
		  <div id="iconoBorrar">
		  	<form name="formBorrar" action="{{action('CentersController@deleteCenter', $centro->id)}}" method="POST" style="display:inline">
        		  {{ method_field('DELETE') }}
        		  {{ csrf_field() }}
        		  <input class="btn btn-danger btn-sm" type="button" onclick="pregunta()" value="Borrar"/>
      		</form>
		  </div>
		  <div id="iconoEditar">
			<a class="btn btn-secondary btn-sm" href="{{ url('/settings/centers/edit/'.$centro->id) }}">Editar</a>
		  </div>
		  </br><hr />
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop