@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center" > Lista de categorías </h4>
        <a class="btn btn-primary btn-sm" href="{{ url('/settings/categories/create') }}">Añadir categoría</a>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Categoría</th>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayCategorias as $key => $categoria )
              <tr>
                <td><a href="{{ url('/settings/categories/show/' . $categoria->id ) }}" style="color: #000000; font-weight: bold;" > {{$categoria->name}} </a></td>

                <td align="right" ><a class="btn btn-secondary btn-sm" href="{{ url('/settings/categories/edit/'.$categoria->id) }}">Editar</a></td>

                <td align="right" ><form name="formBorrar" action="{{action('CategoriesController@deleteCategory', $categoria->id)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                  <button class="btn btn-danger btn-sm" type="submit" onclick="return pregunta()">Borrar</button> 
                </form></td>
              </tr>
            @endforeach
          </tbody>
        </table>	
		  </div>
      <div>
        <a class="btn btn-link btn-sm" href="{{ url('/settings') }}" style="float: right;">Volver a ajustes</a>
      </div>
	  </div>
	</div>
</div>

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
@stop