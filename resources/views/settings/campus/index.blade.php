@extends('layouts.master')
@section('content')
<script language="JavaScript"> 
function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar este campus?');
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
            	<h5 > Lista de campus </h5>
            </div>
            <div id="btnCabecera">
            	<a class="btn btn-primary btn-sm" href="{{ url('/settings/campus/create') }}">Añadir campus</a>
            </div>
          </div>
          <div class="card-body">	
		  @foreach( $arrayCampus as $key => $campus )
		  <div id="nombrelist">
			<h5><a href="{{ url('/settings/campus/show/' . $campus->id ) }}" style="color: #000000;">{{$campus->name}}</a></h5>
		  </div>
		  <div id="iconoBorrar">
		  	<form name="formBorrar" action="{{action('CampusController@deleteCampus', $campus->id)}}" method="POST" style="display:inline">
        		  {{ method_field('DELETE') }}
        		  {{ csrf_field() }}
        		  <input class="btn btn-danger btn-sm" type="submit" onclick="pregunta()" value="Borrar"/>
      		</form>
		  </div>
		  <div id="iconoEditar">
			<a class="btn btn-secondary btn-sm" href="{{ url('/settings/campus/edit/'.$campus->id) }}">Editar</a>
		  </div>
		  </br><hr />
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop