@extends('layouts.master')
@section('content')
<script language="JavaScript"> 
function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta titulación?');
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
            	<h5 > Lista de titulaciones </h5>
            </div>
            <div id="btnCabecera">
            	<a class="btn btn-primary btn-sm" href="{{ url('/settings/certifications/create') }}">Añadir titulación</a>
            </div>
          </div>
          <div class="card-body">	
		  @foreach( $arrayTitulaciones as $key => $titulacion )
		  <div id="nombrelist">
			<h5><a href="{{ url('/settings/certifications/show/' . $titulacion->id ) }}" style="color: #000000;">{{$titulacion->name}}</a></h5>
		  </div>
		  <div id="iconoBorrar">
		  	<form name="formBorrar" action="{{action('CertificationsController@deleteCertification', $titulacion->id)}}" method="POST" style="display:inline">
        		  {{ method_field('DELETE') }}
        		  {{ csrf_field() }}
        		  <input class="btn btn-danger btn-sm" type="submit" onclick="pregunta()" value="Borrar"/>
      		</form>
		  </div>
		  <div id="iconoEditar">
			<a class="btn btn-secondary btn-sm" href="{{ url('/settings/certifications/edit/'.$titulacion->id) }}">Editar</a>
		  </div>
		  </br><hr />
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop