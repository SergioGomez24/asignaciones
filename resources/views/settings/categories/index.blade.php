@extends('layouts.master')
@section('content')
<div class="row" style="margin-top:40px">
  <div class="offset-md-1 col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="text-center" > Lista de categorías </h4>
        <button class="btn btn-light btn-sm" style="float: left;"><a href="{{ url('/settings') }}"><img src={{ asset('img/keyboard_return.png') }} height="15" width="15"/></a></button>
        <a class="btn btn-primary btn-sm" href="{{ url('/settings/categories/create') }}" style="float: right;">Añadir categoría</a>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <td style="font-weight: bold;">Categoría</td>
              <td style="font-weight: bold;">Rango</td>
              <td align="right" style="font-weight: bold;">Editar</td>
              <td align="right" style="font-weight: bold;">Eliminar</td>
            </tr>
          </thead>
          <tbody> 
            @foreach( $arrayCategorias as $key => $categoria )
              <tr>
                <td style="font-weight: bold;">{{$categoria->name}}</td>

                <td style="font-weight: bold;">{{$categoria->rank}}</td>

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
	  </div>
	</div>
</div>

<script language="JavaScript"> 
  $(document).ready(initTableSorter);
  
  function initTableSorter() {
  // call the tablesorter plugin
    $('table').tablesorter({
    // Sort on the second column, in ascending order
      sortList: [[1,0]]
    });
  }

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