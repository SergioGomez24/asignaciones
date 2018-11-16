@extends('layouts.master')
@section('content')
<script language="JavaScript"> 
function pregunta(){ 
    var mensaje = confirm('¿Estas seguro de que quieres borrar esta categoria?');
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
            	<h5 > Lista de categorias </h5>
            </div>
            <div id="btnAñadir">
            	<a class="btn btn-primary btn-sm" href="{{ url('/categories/create') }}">Añadir categoria</a>
            </div>
          </div>
          <div class="card-body">	
		  @foreach( $arrayCategorias as $key => $categoria )
		  <div id="nombrelist">
			<h5><a href="{{ url('/categories/show/' . $categoria->id ) }}" style="color: #000000;">{{$categoria->name}}</a></h5>
		  </div>
		  <div id="iconoBorrar">
		  	<form name="formBorrar" action="{{action('CategoriesController@deleteCategory', $categoria->id)}}" method="POST" style="display:inline">
        		  {{ method_field('DELETE') }}
        		  {{ csrf_field() }}
        		  <input class="btn btn-danger btn-sm" type="button" onclick="pregunta()" value="Borrar"/>
      		</form>
		  </div>
		  <div id="iconoEditar">
			<a class="btn btn-secondary btn-sm" href="{{ url('/categories/edit/'.$categoria->id) }}">Editar</a>
		  </div>
		  </br><hr />
		  @endforeach
		  </div>
	    </div>
	  </div>
	</div>
@stop